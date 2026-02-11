<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // Perbaikan: Gunakan Transaction (Tunggal) sesuai standar Laravel
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerDashboard extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Logika HP Bar & Leveling (Tetap sama)
        $target       = 1000000;
        $hpPercentage = min(max(($user->saldo / $target) * 100, 0), 100);

        $level = 1;
        if ($user->saldo > 5000000) {$level = 3;} elseif ($user->saldo > 1000000) {$level = 2;}

        // 2. AMBIL SEMUA DATA UNTUK PERHITUNGAN TOTAL (Tanpa ->take(5))
        $allTransactions = Transaction::where('id_account', $user->id_account)->get();

        // Hitung total di sini agar lebih ringan
        $totalPemasukan   = $allTransactions->where('tipe', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = $allTransactions->where('tipe', 'Pengeluaran')->sum('jumlah');

        // 3. AMBIL DATA UNTUK TABEL (Hanya 5 Terbaru)
        $transactions = Transaction::where('id_account', $user->id_account)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'transactions',
            'hpPercentage',
            'level',
            'totalPemasukan',
            'totalPengeluaran'
        ));
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
