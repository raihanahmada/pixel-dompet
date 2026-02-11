<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerTransaction extends Controller
{
    public function create()
    {
        return view('user.transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_transaksi' => 'required|string|max:100',
            'tipe'           => 'required|in:Pemasukan,Pengeluaran',
            'jumlah'         => 'required|numeric|min:0.01',
            'tanggal'        => 'required|date',
            'keterangan'     => 'nullable|string',
        ]);

        // Mulai transaksi database agar saldo & record sinkron
        DB::transaction(function () use ($request) {
            $user = Auth::user();

            // 1. Simpan data transaksi
            Transaction::create([
                'id_account'     => $user->id_account,
                'nama_transaksi' => $request->nama_transaksi,
                'tipe'           => $request->tipe,
                'jumlah'         => $request->jumlah,
                'keterangan'     => $request->keterangan,
                'tanggal'        => $request->tanggal,
            ]);

            // 2. Update Saldo di tabel Accounts
            $account = Account::find($user->id_account);
            if ($request->tipe == 'income') {
                $account->saldo += $request->jumlah;
            } else {
                $account->saldo -= $request->jumlah;
            }
            $account->save();
        });

        return redirect()->route('dashboard.index')->with('success', 'Quest Completed! Saldo diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        // 1. Buat Query Dasar untuk Filter
        $baseQuery = Transaction::where('id_account', $user->id_account);

        if ($request->filled('search')) {
            $baseQuery->where('nama_transaksi', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('type')) {
            $baseQuery->where('tipe', $request->type);
        }
        if ($request->filled('month')) {
            $baseQuery->whereMonth('tanggal', date('m', strtotime($request->month)))
                ->whereYear('tanggal', date('Y', strtotime($request->month)));
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $baseQuery->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        // 2. Query untuk TABEL (Pakai Paginate)
        // Gunakan clone agar baseQuery tidak rusak untuk statistik
        $transactions = (clone $baseQuery)->latest('tanggal')->paginate(10);

        // 3. Query untuk GRAFIK (Jangan pakai limit/paginate dari tabel)
        $chartData = [
            'labels' => ['Pengeluaran', 'Pemasukan'],
            'data'   => [
                (clone $baseQuery)->where('tipe', 'Pengeluaran')->sum('jumlah'),
                (clone $baseQuery)->where('tipe', 'Pemasukan')->sum('jumlah'),
            ],
        ];

        // 4. Query untuk TOP EXPENSES (Urutkan berdasarkan SUM jumlah)
        $topExpenses = (clone $baseQuery)->where('tipe', 'Pengeluaran')
            ->select('nama_transaksi', \DB::raw('SUM(jumlah) as total'))
            ->groupBy('nama_transaksi')
            ->reorder() // Membersihkan order by tanggal dari baseQuery
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        return view('user.transactions.show', compact('transactions', 'chartData', 'topExpenses'));
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
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $user        = Auth::user();

        // Kembalikan saldo sebelum transaksi dihapus
        if ($transaction->tipe == 'Pemasukan') {
            $user->saldo -= $transaction->jumlah;
        } else {
            $user->saldo += $transaction->jumlah;
        }

        $user->save();
        $transaction->delete();

        return redirect()->back()->with('success', 'Quest berhasil dihapus dari Log!');
    }
}
