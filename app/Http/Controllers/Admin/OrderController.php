<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ChargeType;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\Order;
use BenSampo\Enum\Rules\EnumValue;
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
        return Inertia::render('Admin/Orders/Index', [
            'filters' => request()->all('search'),
            'orders' => Order::with([
                'user' => function ($query) {
                    return $query->select('id', 'name');
                }, 'vendor.market',
            ])->withCount('products')->filter(request()->all('search'))->orderByDesc('id')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Inertia\Response
     */
    public function show(Order $order)
    {
        return Inertia::render('Admin/Orders/Show', [
            'order' => $order->load('user', 'vendor.market', 'products')->append([
                'product_price_total',
                'product_charge_total',
                'product_grand_total',
                'charge_total',
                'grand_total'
            ]),
            'orderStatuses' => OrderStatus::asSelectArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Inertia\Response
     */
    public function edit(Order $order)
    {
        return Inertia::render('Admin/Orders/Edit', [
            'order' => $order->load('charges'),
            'charges' => Charge::whereIn('target', ['subtotal', 'grandtotal'])->get(),
            'chargeTypes' => ChargeType::asSelectArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->validate([
            'currency_rate' => ['sometimes', 'required', 'numeric', 'min:1'],
            'status' => ['sometimes', 'required', new EnumValue(OrderStatus::class)],
            'shipping_name' => ['sometimes', 'required', 'string'],
            'shipping_phone' => ['sometimes', 'required', 'phone:VN'],
            'shipping_address' => ['sometimes', 'required', 'string'],
        ]));

        return back();
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
