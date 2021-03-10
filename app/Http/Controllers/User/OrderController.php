<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            'filters' => request()->all('search'),
            'orders' => Order::with([
                'products' => function ($query) {
                    return $query->select(['id', 'order_id', 'name', 'image']);
                },
            ])
                ->where('user_id', request()->user()->id)
                ->filter(request()->all('search'))
                ->orderByDesc('created_at')->paginate(),
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
            'order' => $order->load([
                'products', 'vendor.market', 'comments.user'
            ])->append([
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
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('User/Orders/Create', [
            'markets' => Market::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request  $request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'market_id' => ['required', 'exists:markets,id'],
            'shipping_name' => ['required', 'string'],
            'shipping_phone' => ['required', 'phone:VN'],
            'shipping_address' => ['required', 'string'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.name' => ['required', 'string'],
            'products.*.price' => ['required', 'numeric', 'min:1'],
            'products.*.quantity' => ['required', 'numeric', 'min:1'],
            'products.*.url' => ['nullable', 'url'],
            'products.*.image' => ['nullable', 'url'],
            'products.*.options.*.label' => ['sometimes', 'string'],
            'products.*.options.*.value' => ['sometimes', 'string'],
        ]);

        $market = Market::findOrFail($request->market_id);

        $vendor = Vendor::firstOrCreate([
            'market_id' => $market->id,
            'identity' => Str::slug($market->name),
            'name' => $market->name,
        ]);

        $order = new Order($validated);
        $order->currency_code = 'CNY';
        $order->currency_rate = 3690;
        $order->user()->associate($request->user());
        $order->vendor()->associate($vendor);
        $order->save();

        $order->products()->createMany($validated['products']);

        return redirect(route('user.orders.show', $order));
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
