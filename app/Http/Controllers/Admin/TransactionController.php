<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TransactionController extends AdminController
{
    public function show(Transaction $transaction): View
    {
        $this->ensureAdmin();

        $transaction->load('items.product', 'user');

        return view('admin.transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $this->ensureAdmin();

        $transaction->delete();

        return Redirect::back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
