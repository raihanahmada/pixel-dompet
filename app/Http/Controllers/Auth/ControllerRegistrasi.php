<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class ControllerRegistrasi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.registrasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input disesuaikan dengan schema database
        $validatedData = $request->validate([
            'nama_account' => 'required|string|max:50',
            'jenis'        => 'required|in:cash,bank,ewallet', // Validasi enum
            'saldo'        => 'required|numeric|min:0',
            'email'        => 'required|email|unique:accounts,email',
            'password'     => 'required|string|min:8', // Dihapus 'confirmed' agar cocok dengan form
        ]);

        // Hash password
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Simpan data
        Account::create($validatedData);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
