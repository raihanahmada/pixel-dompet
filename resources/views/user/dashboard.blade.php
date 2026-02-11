@extends('layouts.app')

@section('title', 'Player Status')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="md:col-span-1">
            <section class="card h-full"
                style="background: white; border: 4px solid var(--dark); padding: 20px; box-shadow: var(--shadow);">

                <div class="mb-6">
                    <div class="flex justify-between items-end">
                        <label class="text-lg" style="font-family: 'VT323';">WALLET HEALTH (HP)</label>
                        <span class="text-sm">{{ number_format($hpPercentage, 0) }}%</span>
                    </div>
                    <div class="hp-bar-container" style="height: 25px; border: 4px solid #000; background: #333;">
                        <div class="hp-bar-fill"
                            style="width: {{ $hpPercentage }}%; height: 100%;
                            background: {{ $hpPercentage > 50 ? '#4CAF50' : ($hpPercentage > 20 ? '#FFC107' : '#FF5252') }};
                            transition: width 1s ease-in-out;">
                        </div>
                    </div>

                    @if ($hpPercentage <= 20)
                        <p class="text-xs mt-1 animate-pulse" style="color: #FF5252; font-weight: bold;">⚠️ LOW GOLD! GO
                            FARMING!</p>
                    @endif
                </div>

                <div class="text-center mb-6">
                    <div class="mc-sprite" style="font-size: 80px;">
                        {{ $level == 3 ? '👑' : ($level == 2 ? '🛡️' : '🗡️') }}
                    </div>
                    <h2 class="text-2xl mt-2" style="font-family: 'Press Start 2P'; font-size: 14px;">
                        {{ Auth::user()->nama_account }}</h2>
                    <span class="level-badge"
                        style="background: #000; color: #fff; padding: 5px 10px; display: inline-block; font-family: 'VT323'; margin-top: 10px;">
                        LEVEL {{ $level }} - {{ Auth::user()->jenis }}
                    </span>
                </div>

                <div
                    style="background: #fff9c4; border: 3px solid var(--dark); padding: 15px; text-align: center; position: relative;">
                    <p class="text-sm m-0" style="font-family: 'VT323'; font-size: 18px;">CURRENT GOLD</p>
                    <h3 class="text-2xl font-bold text-yellow-700" style="font-family: 'VT323'; font-size: 28px;">
                        🪙 {{ number_format(Auth::user()->saldo, 0, ',', '.') }}
                        <button onclick="toggleEditSaldo()"
                            style="background: none; border: none; cursor: pointer; font-size: 18px;"
                            title="Edit Saldo">✏️</button>
                    </h3>

                    <div id="edit-saldo-form"
                        style="display: none; margin-top: 10px; border-top: 2px dashed #000; padding-top: 10px;">
                        <form action="{{ route('account.updateSaldo') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="saldo" value="{{ Auth::user()->saldo }}"
                                style="width: 100%; border: 2px solid #000; font-family: 'VT323'; text-align: center; font-size: 20px; padding: 5px;">
                            <div class="flex gap-2 mt-2 justify-center">
                                <button type="submit" class="bg-black text-white px-3 py-1 text-sm hover:bg-gray-800"
                                    style="font-family: 'VT323';">SAVE</button>
                                <button type="button" onclick="toggleEditSaldo()"
                                    class="bg-gray-400 text-black px-3 py-1 text-sm"
                                    style="font-family: 'VT323';">CANCEL</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <div class="md:col-span-2">
            <section class="card"
                style="background: white; border: 4px solid var(--dark); padding: 20px; box-shadow: var(--shadow);">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl" style="font-family: 'VT323'; font-size: 24px;">📜 RECENT QUEST LOG</h2>
                    <a href="{{ route('transaction.create') }}"
                        class="bg-green-500 text-white px-3 py-1 border-2 border-black"
                        style="font-family: 'VT323'; font-size: 16px; text-decoration: none;">+ NEW ENTRY</a>
                </div>

                <table class="w-full text-left">
                    <thead>
                        <tr style="border-bottom: 3px solid #000; font-family: 'VT323'; font-size: 18px;">
                            <th class="p-2">DATE</th>
                            <th class="p-2">ACTIVITY</th>
                            <th class="p-2">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody style="font-family: 'VT323'; font-size: 18px;">
                        @forelse($transactions as $trx)
                            <tr style="border-bottom: 1px solid #eee;">
                                <td class="p-2">{{ date('d M Y', strtotime($trx->tanggal)) }}</td>
                                <td class="p-2">{{ $trx->nama_transaksi }}</td>
                                <td class="p-2 {{ $trx->tipe == 'Pemasukan' ? 'text-green-600' : 'text-red-600' }}"
                                    style="font-weight: bold;">
                                    {{ $trx->tipe == 'Pemasukan' ? '+' : '-' }}
                                    {{ number_format($trx->jumlah, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-6 text-gray-400">Belum ada petualangan finansial
                                    hari ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>

            <div class="grid grid-cols-2 gap-4 mt-6">
                <div
                    style="background: #e8f5e9; border: 4px solid var(--dark); padding: 15px; box-shadow: 4px 4px 0px var(--dark);">
                    <p class="text-sm" style="font-family: 'VT323';">TOTAL INCOME (RECENT)</p>
                    <p class="text-xl text-green-700 font-bold" style="font-family: 'VT323';">
                        + {{ number_format($transactions->where('tipe', 'Pemasukan')->sum('jumlah'), 0, ',', '.') }}
                    </p>
                </div>
                <div
                    style="background: #ffebee; border: 4px solid var(--dark); padding: 15px; box-shadow: 4px 4px 0px var(--dark);">
                    <p class="text-sm" style="font-family: 'VT323';">TOTAL EXPENSE (RECENT)</p>
                    <p class="text-xl text-red-700 font-bold" style="font-family: 'VT323';">
                        - {{ number_format($transactions->where('tipe', 'Pengeluaran')->sum('jumlah'), 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleEditSaldo() {
            const form = document.getElementById('edit-saldo-form');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
@endsection
