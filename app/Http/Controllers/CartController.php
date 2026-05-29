<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();

        return view('cart.index', compact('cartItems'));
    }

    public function checkoutForm()
    {
        $cartItems = Auth::user()->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return Redirect::route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        return view('cart.checkout', compact('cartItems'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
            'size' => ['required', 'string'],
        ]);

        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($quantity > $product->stock) {
            return Redirect::back()->with('error', 'Stok untuk produk "'.$product->name.'" tidak mencukupi.');
        }

        $cart = Auth::user()->carts()->firstOrNew([
            'product_id' => $product->id,
            'size' => $request->input('size'),
        ]);

        $cart->quantity = $cart->quantity ? $cart->quantity + $quantity : $quantity;
        $cart->save();

        return Redirect::back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function remove(Cart $cart)
    {
        abort_unless($cart->user_id === Auth::id(), 403);

        $cart->delete();

        return Redirect::back()->with('success', 'Item keranjang dihapus.');
    }

    public function checkout(Request $request)
    {
        $rules = [
            'payment_method' => ['required', 'string', 'max:50'],
            'shipping_method' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:500'],
        ];

        if ($request->filled('product_id')) {
            $rules['product_id'] = ['required', 'exists:products,id'];
            $rules['size'] = ['required', 'string'];
            $rules['quantity'] = ['required', 'integer', 'min:1'];
        }

        $request->validate($rules);

        $user = Auth::user();
        $productId = $request->input('product_id');

        if ($productId) {
            $product = Product::find($productId);
            $quantity = max(1, (int) $request->input('quantity', 1));
            $size = $request->input('size');

            if (!$product) {
                return Redirect::back()->with('error', 'Produk tidak ditemukan.');
            }

            if ($quantity > $product->stock) {
                return Redirect::back()->with('error', 'Stok untuk produk "'.$product->name.'" tidak mencukupi.');
            }

            $cartItems = collect([(object) [
                'product' => $product,
                'quantity' => $quantity,
                'size' => $size,
            ]]);
        } else {
            $cartItems = $user->carts()->with('product')->get();

            if ($cartItems->isEmpty()) {
                return Redirect::back()->with('error', 'Keranjang masih kosong.');
            }
        }

        $total = 0;
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return Redirect::back()->with('error', 'Stok tidak cukup untuk produk "'.$item->product->name.'".');
            }
            $total += $item->quantity * $item->product->price;
        }

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'shipping_method' => $request->shipping_method,
            'address' => $request->address,
        ]);

        foreach ($cartItems as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'size' => $item->size,
            ]);

            $item->product->decrement('stock', $item->quantity);
        }

        if (!$productId) {
            $user->carts()->delete();
        }

        return Redirect::route('transactions.show', $transaction)->with('success', 'Pembelian berhasil. Invoice siap dicetak.');
    }
}
