<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $this->ensureAdmin();

        $products = Product::with('category')->latest()->get();
        $categories = Category::orderBy('name')->get();
        $transactions = Transaction::with('user')->latest()->get();
        $customers = User::where('role', 'pelanggan')->latest()->get();

        return view('admin.dashboard', compact('products', 'categories', 'transactions', 'customers'));
    }

    protected function ensureAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()->role === 'admin', 403);
    }
}
