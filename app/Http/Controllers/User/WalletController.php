<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WalletController extends Controller
{
    public function show()
    {
        return Inertia::render('User/Wallet/Show', [
            'wallet' => request()->user()->wallet,
            'transactions' => Transaction::select('id', 'type', 'amount', 'created_at')
                ->where('wallet_id', request()->user()->wallet->id)
                ->orderByDesc('created_at')
                ->paginate()
        ]);
    }
}
