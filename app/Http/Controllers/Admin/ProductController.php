<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ChargeType;
use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Products/Index', [
            'filters' => request()->all('search'),
            'products' => Product::with([
                'order' => function ($query) {
                    return $query->select('id', 'currency_code');
                },
            ])->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Products/Create');
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
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function show(Product $product)
    {
        return Inertia::render('Admin/Products/Show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Inertia\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Edit', [
            'product' => $product->load('order'),
            'charges' => Charge::all(),
            'chargeTypes' => ChargeType::asSelectArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->validate([
            'name' => ['sometimes', 'required', 'string'],
            'image' => ['sometimes', 'required', 'url'],
            'url' => ['sometimes', 'required', 'url'],
            'price' => ['sometimes', 'required', 'numeric'],
            'quantity' => ['sometimes', 'required', 'numeric', 'min:1'],
            'note' => ['sometimes', 'nullable', 'string'],
        ]));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
