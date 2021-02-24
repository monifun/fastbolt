<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Vendors/Index', [
            'filters' => request()->all('search'),
            'vendors' => Vendor::filter(request()->all('search'))->with('market')->orderByDesc('created_at')->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Vendors/Create', [
            'markets' => Market::select('id', 'name')->orderBy('name')->get()
        ]);
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
            'market_id' => ['required', 'exists:markets,id'],
            'identity' => ['required', 'string', 'unique:vendors'],
            'name' => ['required', 'string'],
        ]);

        $vendor = Vendor::create([
            'market_id' => $request->market_id,
            'identity' => $request->identity,
            'name' => $request->name,
        ]);

        return redirect(route('admin.vendors.show', $vendor));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        return Inertia::render('Admin/Vendors/Show', [
            'vendor' => Vendor::findOrFail($id)
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
        return Inertia::render('Admin/Vendors/Edit', [
            'markets' => Market::select('id', 'name')->orderBy('name')->get(),
            'vendor' => Vendor::findOrFail($id)
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
        $vendor = Vendor::findOrFail($id);

        $request->validate([
            'market_id' => ['required', 'exists:markets,id'],
            'identity' => ['required', 'string', Rule::unique('vendors')->ignore($vendor->id)],
            'name' => ['required', 'string'],
        ]);

        $vendor->update([
            'market_id' => $request->market_id,
            'identity' => $request->identity,
            'name' => $request->name,
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
