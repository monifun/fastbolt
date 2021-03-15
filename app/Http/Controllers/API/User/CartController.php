<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductToCartRequest;
use App\Models\Market;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;

class CartController extends Controller
{
    /**
     * @param  AddProductToCartRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProduct(AddProductToCartRequest $request): \Illuminate\Http\JsonResponse
    {
        // lookup for market
        $market = Market::where('name', $request->market)->firstOrFail();

        // find the vendor or create a new one
        $vendor = Vendor::firstOrCreate([
            'market_id' => $market->id,
            'identity' => $request->seller_id,
            'name' => $request->seller_name,
        ]);

        // create new draft order if there are no draft order with given vendor
        $order = Order::firstOrCreate([
            'user_id' => $request->user()->id,
            'vendor_id' => $vendor->id,
            'is_draft' => true,
        ], [
            'currency_code' => $market->currency_code,
            'currency_rate' => config("novabolt.currency.rates.{$market->currency_code}"),
        ]);

        // loop through each products from request
        collect($request->products)->each(function ($product) use ($order) {
            // check if product exists in the cart or create a new one
            $cartItem = Product::query()->where([
                'order_id' => $order->id,
                'name' => $product['name'],
                'price' => $product['price'],
                'url' => $product['url'],
                'image' => $product['image'],
            ])->when(!isset($product['options']), function ($query) {
                $query->whereJsonLength('options', 0);
            })->when(isset($product['options']), function ($query) use ($product) {
                $query->whereJsonContains('options', $product['options']);
            })->first();

            // if product existed and the quantity is difference then update its quantity otherwise create as new
            if (!$cartItem) {
                $cartItem = new Product($product);
                $cartItem->order()->associate($order);
                $cartItem->save();
            } else {
                $cartItem->quantity = $product['quantity'];
                $cartItem->save();
            }
        });

        return response()->json(['message' => 'resource_created'], 201);
    }
}
