<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validasi login
        $request->authenticate();

        // Regenerasi session
        $request->session()->regenerate();

        // Ambil user yang login
        $user = Auth::user();

        // Jika Admin
        if ($user && $user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // Jika Masyarakat
        if ($user && $user->isMasyarakat()) {
            return redirect()->route('masyarakat.dashboard');
        }

        // Jika role tidak dikenali
        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Role akun tidak dikenali.',
            ]);
    }

    /**
     * Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}