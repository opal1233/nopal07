<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->get();
        $products = Product::latest()->take(8)->get();

        return view('welcome', compact('categories', 'products'));
    }
}
