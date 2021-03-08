<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Users/Index', [
            'filters' => request()->all('search'),
            'users' => User::withCount('orders')->filter(request()->all('search'))->orderByDesc('created_at')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Users/Create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'phone:VN', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'email_verified' => ['required', 'boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => $request->email_verified ? now() : null,
        ]);

        return redirect(route('admin.users.show', $user));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show(User $user)
    {
        return Inertia::render('Admin/Users/Show', [
            'user' => $user->load([
                'orders' => function ($query) {
                    return $query->orderByDesc('created_at')->limit(10);
                },
                'transactions' => function ($query) {
                    return $query->orderByDesc('created_at')->limit(10);
                },
            ]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Inertia\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id),
            ],
            'phone' => ['sometimes', 'required', 'phone:VN', Rule::unique('users')->ignore($user->id)],
            'password' => ['sometimes', 'required', 'string', 'confirmed'],
            'email_verified' => ['sometimes', 'required', 'boolean'],
        ]);
        // Update user profile information without password and verification status
        $user->update($request->except(['password', 'email_verified']));

        // Update password if present
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update verification status if present
        if ($request->filled('email_verified')) {
            $user->update([
                'email_verified_at' => $request->email_verified ? now() : null,
            ]);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
