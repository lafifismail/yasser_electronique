<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function showCategory(string $slug): View
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('is_active', true)
            ->with(['images' => fn($q) => $q->orderBy('sort_order')])
            ->latest()
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('storefront.category', compact('category', 'products', 'categories'));
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

        return view('storefront.product', compact('product', 'categories'));
    }
}
