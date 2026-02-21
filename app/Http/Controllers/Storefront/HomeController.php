<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $latestProducts = Product::where('is_active', true)
            ->with(['images' => fn($q) => $q->orderBy('sort_order')])
            ->latest()
            ->take(8)
            ->get();

        return view('storefront.home', compact('categories', 'latestProducts'));
    }
}
