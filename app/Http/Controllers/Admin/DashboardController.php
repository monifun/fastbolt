<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalUsersCount = User::count();
        $last30DaysUsersCount = User::whereBetween('created_at', [
            now()->subDays(30)->startOfDay()->toDateTimeString(),
            now()->toDateTimeString(),
        ])->count();

        $totalTransactionsCount = Transaction::count();
        $last30DaysTransactionsCount = Transaction::whereBetween('created_at', [
            now()->subDays(30)->startOfDay()->toDateTimeString(),
            now()->toDateTimeString(),
        ])->count();

        $totalOrdersCount = Order::count();
        $last30DaysOrdersCount = Order::whereBetween('created_at', [
            now()->subDays(30)->startOfDay()->toDateTimeString(),
            now()->toDateTimeString(),
        ])->count();

        $totalProductsCount = Product::count();
        $last30DaysProductsCount = Product::whereBetween('created_at', [
            now()->subDays(30)->startOfDay()->toDateTimeString(),
            now()->toDateTimeString(),
        ])->count();

        $recentOrders = Order::with([
            'user' => function ($query) {
                return $query->select('id', 'name');
            },
        ])->orderByDesc('created_at')->limit(6)->get();

        $topMarkets = Market::withCount('orders')->orderByDesc('orders_count')->limit(5)->get();

        $period = new \DatePeriod(Carbon::now()->subDays(30), CarbonInterval::day(), Carbon::now()->addDay());

        $orders_data = Order::whereBetween('created_at', [
            Carbon::now()->subDays(30)->format('Y-m-d')." 00:00:00",
            Carbon::now()->format('Y-m-d')." 23:59:59"
        ])
            ->groupBy('day')
            ->orderBy('day')
            ->get([
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day'),
                \DB::raw('count(*) as total')
            ])
            ->keyBy('day')
            ->map(function ($item) {
                $item->created_at = Carbon::parse($item->created_at);
                return $item;
            });

        $orders_graph = array_map(function ($datePeriod) use ($orders_data) {
            $date = $datePeriod->format('Y-m-d');
            return $orders_data->has($date) ? $orders_data->get($date)->total : 0;

        }, iterator_to_array($period));

        return Inertia::render('Admin/Dashboard', [
            'totalUsersCount' => $totalUsersCount,
            'last30DaysUsersCount' => $last30DaysUsersCount,
            'totalTransactionsCount' => $totalTransactionsCount,
            'last30DaysTransactionsCount' => $last30DaysTransactionsCount,
            'totalOrdersCount' => $totalOrdersCount,
            'last30DaysOrdersCount' => $last30DaysOrdersCount,
            'recentOrders' => $recentOrders,
            'totalProductsCount' => $totalProductsCount,
            'last30DaysProductsCount' => $last30DaysProductsCount,
            'topMarkets' => $topMarkets,
            'orders_graph' => $orders_graph,
        ]);
    }
}
