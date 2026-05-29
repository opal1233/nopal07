<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends AdminController
{
    public function resetPassword(User $user)
    {
        $this->ensureAdmin();

        abort_unless($user->role === 'pelanggan', 403);

        $user->password = Hash::make('password');
        $user->save();

        return Redirect::back()->with('success', 'Password pelanggan berhasil direset ke "password".');
    }
}
