@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 style="font-family: 'Press Start 2P'; font-size: 18px;" class="mb-6">📜 QUEST LOG & STATS</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="card p-4" style="background: white; border: 4px solid #000; box-shadow: 8px 8px 0px #000;">
                <h2 class="text-center mb-4" style="font-family: 'VT323'; font-size: 24px;">GOLD DISTRIBUTION</h2>
                <div style="max-height: 300px; display: flex; justify-content: center;">
                    <canvas id="financeChart"></canvas>
                </div>
            </div>

            <div class="card p-4" style="background: white; border: 4px solid #000; box-shadow: 8px 8px 0px #000;">
                <h2 class="mb-4" style="font-family: 'VT323'; font-size: 24px;">🔥 TOP EXPENSES</h2>
                <ul class="space-y-2">
                    @forelse ($topExpenses as $item)
                        <li class="flex justify-between border-b-2 border-dashed border-gray-300 p-1">
                            <span style="font-family: 'VT323'; font-size: 18px;">{{ $item->nama_transaksi }}</span>
                            <span class="font-bold text-red-600" style="font-family: 'VT323'; font-size: 18px;">
                                Rp {{ number_format($item->total, 0, ',', '.') }}
                            </span>
                        </li>
                    @empty
                        <p class="text-gray-500 italic">No expense data found.</p>
                    @endforelse
                </ul>
            </div>
        </div>
        <section class="card mb-6"
            style="background: #f9f9f9; border: 4px solid #000; padding: 20px; box-shadow: 4px 4px 0px #000; overflow: hidden;">
            <form action="{{ route('transaction.show') }}" method="GET">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-end">

                    <div class="lg:col-span-3">
                        <label style="font-family: 'VT323'; font-size: 16px; display: block;">SEARCH:</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            style="width: 100%; border: 3px solid #000; padding: 5px; font-family: 'VT323';">
                    </div>

                    <div class="lg:col-span-2">
                        <label style="font-family: 'VT323'; font-size: 16px; display: block;">QUEST_TYPE:</label>
                        <select name="type"
                            style="width: 100%; border: 3px solid #000; padding: 5px; font-family: 'VT323'; background: white;">
                            <option value="">ALL</option>
                            <option value="Pemasukan" {{ request('type') == 'Pemasukan' ? 'selected' : '' }}>🟢 INCOME
                            </option>
                            <option value="Pengeluaran" {{ request('type') == 'Pengeluaran' ? 'selected' : '' }}>🔴 EXPENSE
                            </option>
                        </select>
                    </div>

                    <div class="lg:col-span-2">
                        <label style="font-family: 'VT323'; font-size: 16px; display: block;">MONTH:</label>
                        <input type="month" name="month" value="{{ request('month') }}"
                            style="width: 100%; border: 3px solid #000; padding: 5px; font-family: 'VT323';">
                    </div>

                    <div class="lg:col-span-5">
                        <label style="font-family: 'VT323'; font-size: 16px; display: block;">DATE_RANGE:</label>
                        <div class="flex flex-wrap sm:flex-nowrap gap-2">
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                style="flex: 1; min-width: 120px; border: 3px solid #000; padding: 5px; font-family: 'VT323';">
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                style="flex: 1; min-width: 120px; border: 3px solid #000; padding: 5px; font-family: 'VT323';">
                            <button type="submit"
                                class="bg-black text-white px-3 py-1 border-2 border-white hover:bg-gray-800"
                                style="font-family: 'VT323';">APPLY</button>
                            <a href="{{ route('transaction.show') }}"
                                class="bg-gray-300 text-black px-3 py-1 border-2 border-black text-center no-underline"
                                style="font-family: 'VT323';">RESET</a>
                        </div>
                    </div>

                </div>
            </form>
        </section>
        <div class="card p-4 bg-white" style="border: 4px solid #000; box-shadow: 8px 8px 0px #000;">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr style="border-bottom: 4px solid #000; font-family: 'VT323'; font-size: 20px;">
                            <th class="p-2">DATE</th>
                            <th class="p-2">ACTIVITY</th>
                            <th class="p-2">AMOUNT</th>
                            <th class="p-2">ACTION</th>
                        </tr>
                    </thead>
                    <tbody style="font-family: 'VT323'; font-size: 18px;">
                        @forelse ($transactions as $t)
                            <tr style="border-bottom: 2px solid #eee;">
                                <td class="p-2">{{ date('d/m/Y', strtotime($t->tanggal)) }}</td>
                                <td class="p-2">{{ $t->nama_transaksi }}</td>
                                <td class="p-2 {{ $t->tipe == 'Pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                    <strong>{{ $t->tipe == 'Pemasukan' ? '+' : '-' }} Rp
                                        {{ number_format($t->jumlah, 0, ',', '.') }}</strong>
                                </td>
                                <td class="p-2">
                                    <form action="{{ route('transaction.destroy', $t->id_transaction) }}" method="POST"
                                        onsubmit="return confirm('Hapus record petualangan ini? Saldo akan dikalkulasi ulang.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white border-2 border-black px-3 py-1 hover:bg-red-700 transition-colors">
                                            [ DROP ITEM ]
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-400">Belum ada petualangan finansial
                                    yang tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $transactions->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('financeChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    data: {!! json_encode($chartData['data']) !!},
                    backgroundColor: ['#FF5252', '#4CAF50'], // Red for Expense, Green for Income
                    borderWidth: 4,
                    borderColor: '#000'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                family: 'VT323',
                                size: 18
                            },
                            color: '#000'
                        }
                    }
                }
            }
        });
    </script>
@endsection
