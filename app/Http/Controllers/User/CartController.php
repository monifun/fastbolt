<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function show(Request $request)
    {
        return Inertia::render('User/Cart/Show', [
            'orders' => Order::with('vendor', 'products', 'charges')
                ->where('user_id', $request->user()->id)
                ->where('is_draft', true)
                ->whereHas('products')
                ->get()
                ->each(function ($order) {
                    $order->append([
                        'product_price_total',
                        'product_charge_total',
                        'product_grand_total',
                        'charge_total',
                        'grand_total',
                    ]);
                }),
        ]);
    }

    public function addProduct(Request $request)
    {
        //
    }

    /**
     * @param  Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct(Request $request, Product $product)
    {
        abort_if($product->order->user_id !== $request->user()->id, 403);

        $product->update($request->validate([
            'quantity' => ['sometimes', 'required', 'numeric', 'min:1'],
            'note' => ['sometimes', 'nullable', 'string'],
        ]));

        return back();
    }

    /**
     * @param  Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroyProduct(Request $request, Product $product)
    {
        abort_if($product->order->user_id !== $request->user()->id, 403);

        $product->delete();

        return back();
    }

    public function confirmOrder(Request $request, Order $order)
    {
        $order->update($request->validate([
            'shipping_name' => ['required', 'string'],
            'shipping_phone' => ['required', 'phone:VN'],
            'shipping_address' => ['required', 'string']
        ]));
        $order->is_draft = false;
        $order->currency_rate = config("novabolt.currency.rates.{$order->currency_code}");
        $order->save();

        return redirect()->route('user.orders.show', $order);
    }

    /**
     * @param  Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroyOrder(Request $request, Order $order)
    {
        abort_if($order->user_id !== $request->user()->id, 403);

        $order->delete();

        return back();
    }
}
