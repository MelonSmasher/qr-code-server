<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Ppsk;

class ProfileController extends Controller {

    /**
     * Redirect to the correct page based on the user's authentication status.
     * @return RedirectResponse
     */
    public function welcome(): RedirectResponse {
        // if user is authenticated, redirect to dashboard, if not redirect to login
        return Auth::check() ? Redirect::route('dashboard') : Redirect::route('login');
    }

    /**
     * Display the dashboard
     * @return View
     */
    public function dashboard(): View {
        $ppsks = Ppsk::paginate(10);

        return view('dashboard', [
            'ppsks' => $ppsks,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
// This method is commented out because this uses LDAP authentication, which does not allow for updating user information
//    public function update(ProfileUpdateRequest $request): RedirectResponse {
//        $request->user()->fill($request->validated());
//
//        if ($request->user()->isDirty('email')) {
//            $request->user()->email_verified_at = null;
//        }
//
//        $request->user()->save();
//
//        return Redirect::route('profile.edit')->with('status', 'profile-updated');
//    }

    /**
     * Delete the user's account.
     */
// This method is commented out because this uses LDAP authentication, which does not allow for deleting user accounts
//    public function destroy(Request $request): RedirectResponse {
//        $request->validateWithBag('userDeletion', [
//            'password' => ['required', 'current_password'],
//        ]);
//
//        $user = $request->user();
//
//        Auth::logout();
//
//        $user->delete();
//
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//
//        return Redirect::to('/');
//    }
}
