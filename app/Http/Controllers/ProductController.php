<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::with('category')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category_id', $request->query('category'));
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->query('search') . '%')
                      ->orWhere('description', 'like', '%' . $request->query('search') . '%');
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    public function buyNow(Product $product): View
    {
        return view('products.buy-now', compact('product'));
    }
}
