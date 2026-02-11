<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // Perbaikan: Gunakan Transaction (Tunggal) sesuai standar Laravel
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ControllerDashboard extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Logika HP Bar
        $target = 1000000;
        // Gunakan saldo dari data user yang sedang login
        $hpPercentage = ($user->saldo / $target) * 100;
        $hpPercentage = min(max($hpPercentage, 0), 100);

        // 2. Logika Leveling
        $level = 1;
        if ($user->saldo > 5000000) {
            $level = 3;
        } elseif ($user->saldo > 1000000) {
            $level = 2;
        }

        // 3. Ambil Data Transaksi Terbaru
        // HAPUS ->with('category') karena tabel kategori sudah tidak ada
        $transactions = Transaction::where('id_account', $user->id_account)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('transactions', 'hpPercentage', 'level'));
    }
    public function updateSaldo(Request $request)
    {
        $request->validate([
            'saldo' => 'required|numeric|min:0',
        ]);

        $user        = Auth::user();
        $user->saldo = $request->saldo;
        $user->save();

        return redirect()->back()->with('success', 'GOLD_AMOUNT_SYNCED! Saldo berhasil diperbarui.');
    }
}
