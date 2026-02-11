<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerLogin extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Proses Otentikasi
        // Laravel akan otomatis mengecek email dan meng-hash password untuk dicocokkan
        if (Auth::attempt($credentials)) {
            // Jika berhasil, buat ulang session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke halaman dashboard (atau halaman utama)
            return redirect()->intended('/dashboard')
                ->with('success', 'Welcome back, Adventurer! Data loaded successfully.');
        }

        // 3. Jika Gagal
        // Kembali ke halaman login dengan pesan error ala RPG
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Game Saved. See you next time!');
    }
}
