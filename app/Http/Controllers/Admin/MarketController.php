<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Markets/Index', [
            'filters' => request()->all('search'),
            'markets' => Market::filter(request()->all('search'))->withCount('vendors')->orderByDesc('created_at')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Markets/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'website' => ['required', 'url', 'unique:markets'],
            'currency_code' => ['required', Rule::in(collect(config('fastbolt.currency.rates'))->keys())],
            'description' => ['nullable', 'string'],
        ]);

        $market = Market::create([
            'name' => $request->name,
            'website' => $request->website,
            'currency_code' => $request->currency_code,
            'description' => $request->description,
        ]);

        return redirect(route('admin.markets.show', $market));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        return Inertia::render('Admin/Markets/Show', [
            'market' => Market::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        return Inertia::render('Admin/Markets/Edit', [
            'market' => Market::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $market = Market::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string'],
            'website' => ['sometimes', 'required', 'url', Rule::unique('markets')->ignore($market->id)],
            'currency_code' => ['required', Rule::in(collect(config('fastbolt.currency.rates'))->keys())],
            'description' => ['nullable', 'string'],
        ]);

        $market->update([
            'name' => $request->name,
            'website' => $request->website,
            'currency_code' => $request->currency_code,
            'description' => $request->description,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
