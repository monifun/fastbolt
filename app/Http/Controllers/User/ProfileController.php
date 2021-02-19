<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Show user profile
     *
     * @param  Request  $request
     * @return \Inertia\Response
     */
    public function show(Request $request)
    {
        return Inertia::render('User/Profile/Show');
    }

    /**
     * Validate and update the given user's profile information.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validated = $request->validateWithBag('updateUserProfile', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($request->user()->id)],
            'phone' => ['required', 'phone:VN', Rule::unique('users')->ignore($request->user()->id)],
        ]);

        if ($request['email'] !== $request->user()->email &&
            $request->user() instanceof MustVerifyEmail) {
            // Update verified user and resend email verification
            $validated['email_verified_at'] = null;
            $request->user()->update($validated);
            $request->user()->sendEmailVerificationNotification();
        } else {
            $request->user()->update($validated);
        }

        return back();
    }
}
