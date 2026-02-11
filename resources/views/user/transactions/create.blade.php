@extends('layouts.app')

@section('title', 'New Quest - Entry Transaction')

@section('content')
    <div class="mx-auto" style="max-width: 600px; padding: 20px;">

        @include('layouts.alerts')

        <section class="card"
            style="background: white; border: 4px solid #000; padding: 30px; box-shadow: 8px 8px 0px #000;">
            <div
                style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px; border-bottom: 4px solid #000; padding-bottom: 15px;">
                <span style="font-size: 40px;">💰</span>
                <div>
                    <h2 style="font-family: 'Press Start 2P', cursive; font-size: 14px; margin: 0;">NEW TRANSACTION</h2>
                    <p style="font-family: 'VT323', monospace; font-size: 18px; color: #666; margin: 0;">Catat aktivitas
                        keuanganmu di sini</p>
                </div>
            </div>

            <form action="{{ route('transaction.store') }}" method="POST">
                @csrf

                <div style="margin-bottom: 20px;">
                    <label
                        style="display: block; font-family: 'VT323'; font-size: 20px; margin-bottom: 10px;">TYPE_OF_QUEST:</label>
                    <div style="display: flex; gap: 30px; font-family: 'VT323'; font-size: 20px;">
                        <label style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <input type="radio" name="tipe" value="Pengeluaran" checked required>
                            <span style="color: #c62828; font-weight: bold;">🔴 EXPENSE (Keluar)</span>
                        </label>
                        <label style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <input type="radio" name="tipe" value="Pemasukan" required>
                            <span style="color: #2e7d32; font-weight: bold;">🟢 INCOME (Masuk)</span>
                        </label>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label
                        style="display: block; font-family: 'VT323'; font-size: 20px; margin-bottom: 5px;">SELECT_ACTIVITY:</label>
                    <select id="preset_nama" class="form-control" style="width: 100%; padding: 12px; border: 4px solid #000; font-family: 'VT323'; font-size: 20px; background: #f9f9f9; cursor: pointer;">

                        <option value="Makan" data-type="Pengeluaran">🍔 Makan</option>
                        <option value="Rokok" data-type="Pengeluaran">🚬 Rokok</option>
                        <option value="Paket Data" data-type="Pengeluaran">📡 Paket Data</option>
                        <option value="Jajan" data-type="Pengeluaran">🍦 Jajan</option>
                        <option value="Bayar Hutang" data-type="Pengeluaran">☠️ Bayar Hutang</option>
                        <option value="Ngutangin" data-type="Pengeluaran">☠️ Ngutangin</option>

                        <option value="Di Transfer Ortu" data-type="Pemasukan">💼 Transfer Ortu</option>
                        <option value="Beasiswa" data-type="Pemasukan">💰 Beasiswa</option>
                        <option value="Temen bayar utangnya" data-type="Pemasukan">☠️ Temen bayar utangnya</option>

                        <option value="custom">➕ Input Sendiri (Custom)</option>
                        </select>
                </div>

                <div id="custom_input_container" style="margin-bottom: 20px;">
                    <label
                        style="display: block; font-family: 'VT323'; font-size: 20px; margin-bottom: 5px;">TRANSACTION_NAME:</label>
                    <input type="text" id="nama_transaksi_input" name="nama_transaksi" value="Makan" required
                        style="width: 100%; padding: 12px; border: 4px solid #000; font-family: 'VT323'; font-size: 22px;"
                        placeholder="Contoh: Beli bensin, Top up game...">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-family: 'VT323'; font-size: 20px; margin-bottom: 5px;">AMOUNT
                        (GOLD):</label>
                    <div style="position: relative;">
                        <span
                            style="position: absolute; left: 12px; top: 12px; font-family: 'VT323'; font-size: 22px; font-weight: bold;">Rp</span>
                        <input type="number" name="jumlah" placeholder="0" step="0.01" required
                            style="width: 100%; padding: 12px 12px 12px 45px; border: 4px solid #000; font-family: 'VT323'; font-size: 26px; color: #b8860b; font-weight: bold;">
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label
                        style="display: block; font-family: 'VT323'; font-size: 20px; margin-bottom: 5px;">DATE_OF_TRANSACTION:</label>
                    <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required
                        style="width: 100%; padding: 12px; border: 4px solid #000; font-family: 'VT323'; font-size: 18px;">
                </div>

                <div style="display: flex; gap: 15px; margin-top: 30px;">
                    <button type="submit"
                        style="flex: 2; background: #000; color: #fff; border: none; padding: 15px; font-family: 'Press Start 2P', cursive; font-size: 12px; cursor: pointer; box-shadow: 4px 4px 0px #666;">
                        SUBMIT QUEST
                    </button>
                    <a href="{{ route('dashboard.index') }}"
                        style="flex: 1; background: #ccc; color: #000; border: 4px solid #000; padding: 15px; text-decoration: none; text-align: center; font-family: 'VT323'; font-size: 20px; font-weight: bold;">
                        CANCEL
                    </a>
                </div>
            </form>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const presetSelect = document.getElementById('preset_nama');
            const hiddenInput = document.getElementById('nama_transaksi_input');
            const typeRadios = document.querySelectorAll('input[name="tipe"]');
            const options = presetSelect.querySelectorAll('option');

            function filterOptions() {
                // Ambil tipe yang sedang dipilih (expense atau income)
                const selectedType = document.querySelector('input[name="tipe"]:checked').value;

                let firstVisibleOption = null;

                options.forEach(option => {
                    const optionType = option.getAttribute('data-type');

                    // Tampilkan jika tipe cocok ATAU jika itu pilihan 'custom'
                    if (optionType === selectedType || option.value === 'custom') {
                        option.style.display = 'block';
                        option.disabled = false;
                        if (!firstVisibleOption) firstVisibleOption = option;
                    } else {
                        option.style.display = 'none';
                        option.disabled = true;
                    }
                });

                // Otomatis pilih opsi pertama yang tersedia agar tidak "nyangkut" di pilihan lama
                if (firstVisibleOption) {
                    presetSelect.value = firstVisibleOption.value;
                    hiddenInput.value = firstVisibleOption.value !== 'custom' ? firstVisibleOption.value : '';
                }
            }

            // Jalankan filter saat halaman pertama kali dimuat
            filterOptions();

            // Jalankan filter setiap kali Radio Button diklik
            typeRadios.forEach(radio => {
                radio.addEventListener('change', filterOptions);
            });

            // Logika Input Custom (Tetap seperti sebelumnya)
            presetSelect.addEventListener('change', function() {
                if (this.value === 'custom') {
                    hiddenInput.value = '';
                    hiddenInput.placeholder = "Ketik aktivitas di sini...";
                    hiddenInput.focus();
                } else {
                    hiddenInput.value = this.value;
                }
            });
        });
    </script>

    <style>
        /* Tambahan style agar hover tombol terasa pixelated */
        button:hover {
            background: #333 !important;
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #000 !important;
        }

        input:focus,
        select:focus {
            outline: none;
            background: #fffbe6 !important;
            /* Efek highlight saat diisi */
        }
    </style>
@endsection
