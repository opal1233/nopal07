<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function show(Transaction $transaction): View
    {
        $user = Auth::user();

        if ($user->role !== 'admin' && $transaction->user_id !== $user->id) {
            abort(403);
        }

        $transaction->load('items.product', 'user');

        return view('transactions.show', compact('transaction'));
    }
}
