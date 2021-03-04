<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalUsersCount = User::count();
        $last30DaysUsersCount = User::whereBetween('created_at', [
            now()->subDays(30)->toDateString(),
            now()->toDateString(),
        ])->count();

        $totalOrdersCount = Order::count();
        $last30DaysOrdersCount = Order::whereBetween('created_at', [
            now()->subDays(30)->toDateString(),
            now()->toDateString(),
        ])->count();

        $totalProductsCount = Product::count();
        $last30DaysProductsCount = Product::whereBetween('created_at', [
            now()->subDays(30)->toDateString(),
            now()->toDateString(),
        ])->count();

        $recentOrders = Order::with([
            'user' => function ($query) {
                return $query->select('id', 'name');
            },
        ])->orderByDesc('created_at')->limit(6)->get();

        $topMarkets = Market::withCount('orders')->orderByDesc('orders_count')->limit(5)->get();

        return Inertia::render('Admin/Dashboard', [
            'totalUsersCount' => $totalUsersCount,
            'last30DaysUsersCount' => $last30DaysUsersCount,
            'totalOrdersCount' => $totalOrdersCount,
            'last30DaysOrdersCount' => $last30DaysOrdersCount,
            'recentOrders' => $recentOrders,
            'totalProductsCount' => $totalProductsCount,
            'last30DaysProductsCount' => $last30DaysProductsCount,
            'topMarkets' => $topMarkets,
        ]);
    }
}
