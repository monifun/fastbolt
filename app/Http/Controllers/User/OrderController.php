<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('User/Orders/Index', [
            'orders' => Order::with([
                'products' => function ($query) {
                    return $query->select(['id', 'order_id', 'name', 'image']);
                },
            ])->where('user_id', request()->user()->id)->paginate(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Inertia\Response
     */
    public function show(Order $order)
    {
        abort_if($order->user_id !== request()->user()->id, 404);

        return Inertia::render('User/Orders/Show', [
            'order' => $order->load('products', 'vendor.market')->append([
                'product_price_total',
                'product_charge_total',
                'product_grand_total',
                'charge_total',
                'grand_total',
                'total_paid',
                'total_due',
            ]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
