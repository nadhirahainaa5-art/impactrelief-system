<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display login page
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | BLOCK INACTIVE STAFF
        |--------------------------------------------------------------------------
        */
        if ($user->role === 'staff' && $user->status === 'inactive') {

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login')->withErrors([
                'email' => 'Your staff account is inactive. Please contact administrator.',
            ]);
        }

        // ADMIN
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // STAFF
        if ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        }

        // DONOR
        if ($user->role === 'donor') {
            return redirect()->route('dashboard');
        }

        // fallback
        Auth::logout();

        return redirect()->route('login')->withErrors([
            'email' => 'Account role not recognized.',
        ]);
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}