<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserWalletController extends Controller
{
    /**
     * Deposit to user wallet
     *
     * @param  Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deposit(Request $request, User $user)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:1']
        ]);

        $user->wallet->validateBalance(true);

        $user->transactions()->create([
            'wallet_id' => $user->wallet->id,
            'type' => 'deposit',
            'status' => TransactionStatus::COMPLETED,
            'amount' => $request->amount,
            'meta' => $request->meta,
            'note' => $request->note,
        ]);

        $user->wallet->validateBalance(true);

        return back();
    }

    /**
     * Refresh user balance
     *
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function refresh(User $user)
    {
        $user->wallet->validateBalance(true);

        return back();
    }
}
