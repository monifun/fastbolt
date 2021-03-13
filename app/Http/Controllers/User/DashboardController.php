<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function __invoke()
    {
        $orders_count = request()->user()->orders()->count();
        $transactions_count = request()->user()->transactions()->count();
        $shipments_count = request()->user()->shipments()->count();
        $comments_count = request()->user()->comments()->count();

        $recent_orders = request()->user()->orders()->with('products')->orderByDesc('created_at')->limit(10)->get();

        return Inertia::render('User/Dashboard', [
            'orders_count' => $orders_count,
            'transactions_count' => $transactions_count,
            'shipments_count' => $shipments_count,
            'comments_count' => $comments_count,
            'recent_orders' => $recent_orders,
        ]);
    }
}
