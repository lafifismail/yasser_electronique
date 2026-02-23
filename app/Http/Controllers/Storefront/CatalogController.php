<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function showCategory(Request $request, string $slug): View
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Marques pour la sidebar (toutes, pas seulement dans la catégorie)
        $brands = Brand::orderBy('name')->get();

        // Requête de base
        $query = $category->products()
            ->where('is_active', true)
            ->with(['images' => fn($q) => $q->orderBy('sort_order'), 'brand']);

        // Filtre Marque (checkbox multiples → tableau d'IDs)
        if ($request->filled('brands')) {
            $query->whereIn('brand_id', $request->input('brands'));
        }

        // Filtre Condition (radio → valeur unique)
        if ($request->filled('condition')) {
            $query->where('condition', $request->input('condition'));
        }

        // Tri par date + pagination (withQueryString = filtres conservés sur pages suivantes)
        $products = $query->latest()->paginate(12)->withQueryString();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('storefront.category', compact('category', 'products', 'brands', 'categories'));
    }

    public function showProduct(string $slug): View
    {
        $product = Product::where('slug', $slug)
            ->with([
                'images' => fn($q) => $q->orderBy('sort_order'),
                'attributes' => fn($q) => $q->orderBy('sort_order'),
                'category',
                'brand',
            ])
            ->firstOrFail();

        abort_if(!$product->is_active, 404);

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        // Produits similaires : même catégorie, différent, actifs, max 4
        $relatedProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn($q) => $q->where('category_id', $product->category_id))
            ->with(['images' => fn($q) => $q->orderBy('sort_order')])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('storefront.product', compact('product', 'categories', 'relatedProducts'));
    }

    public function search(Request $request): View
    {
        $keyword = trim($request->input('q', ''));

        $products = Product::where('is_active', true)
            ->when($keyword !== '', function ($q) use ($keyword) {
                $q->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('short_description', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
                });
            })
            ->with([
                'images' => fn($q) => $q->orderBy('sort_order'),
                'brand',
            ])
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('storefront.search', compact('products', 'keyword', 'categories'));
    }
}
