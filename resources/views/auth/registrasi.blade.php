@extends('layouts.app')

@section('title', 'New Account - Register')

@push('styles')
    <style>
        /* Styling khusus untuk elemen select agar tetap pixelated */
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%3E%3Cpath%20fill%3D%22%23212529%22%20d%3D%22M7%2010l5%205%205-5z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
        }

        input:focus,
        select:focus {
            background-color: #fff9c4 !important;
            border-color: var(--cta) !important;
            outline: none;
            box-shadow: 0 0 10px rgba(255, 64, 129, 0.3);
        }
    </style>
@endpush

@section('content')
    <div class="mx-auto" style="max-width: 550px;">
        <section class="hero"
            style="background: white; padding: 40px 20px; border: 4px solid var(--dark); box-shadow: var(--shadow); text-align: center; border-color: var(--primary);">
            <h2 style="font-size: 18px; margin-bottom: 10px;">CREATE NEW ACCOUNT</h2>
            <p style="font-size: 14px; color: #666;">PILIH CLASS DAN MULAI PETUALANGANMU</p>
            <div class="alert-container" style="margin-bottom: 20px; text-align: left; font-family: 'VT323', monospace;">

                {{-- Pesan Sukses (Success Message) --}}
                @if (session('success'))
                    <div
                        style="background: #eaffd0; border: 4px solid var(--primary); padding: 15px; box-shadow: 4px 4px 0px var(--dark); animation: blink 1s; display: flex; align-items: center; gap: 10px;">
                        <span style="font-size: 25px;">🎁</span>
                        <div>
                            <strong
                                style="display: block; font-family: 'Press Start 2P'; font-size: 10px; color: var(--primary);">SYSTEM
                                SUCCESS!</strong>
                            <span style="font-size: 18px;">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                {{-- Pesan Error (Validation Errors) --}}
                @if ($errors->any())
                    <div
                        style="background: #ffe5e5; border: 4px solid #ff4081; padding: 15px; box-shadow: 4px 4px 0px var(--dark);">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <span style="font-size: 25px;">💀</span>
                            <strong style="font-family: 'Press Start 2P'; font-size: 10px; color: #ff4081;">CRITICAL
                                ERROR!</strong>
                        </div>
                        <ul style="font-size: 18px; list-style: none; padding: 0; margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li style="margin-bottom: 5px;">> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{ route('register.store') }}" method="POST"
                style="display: flex; flex-direction: column; gap: 15px; text-align: left; margin-top: 20px;">
                @csrf

                <div>
                    <label style="display: block; margin-bottom: 5px;">ACCOUNT_NAME:</label>
                    <input type="text" name="nama_account" placeholder="Contoh: Dompet Utama" maxlength="50" required
                        style="width: 100%; padding: 10px; border: 4px solid var(--dark); font-family: 'VT323'; font-size: 20px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 5px;">ACCOUNT_CLASS (JENIS):</label>
                    <select name="jenis" required
                        style="width: 100%; padding: 10px; border: 4px solid var(--dark); font-family: 'VT323'; font-size: 20px; background-color: white;">
                        <option value="" disabled selected>Pilih Jenis Akun...</option>
                        <option value="cash">CASH (⚔️ Warrior)</option>
                        <option value="bank">BANK (🛡️ Paladin)</option>
                        <option value="ewallet">E-WALLET (🧙‍♂️ Mage)</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; margin-bottom: 5px;">EMAIL_ADDR:</label>
                    <input type="email" name="email" placeholder="player@pixel.com" required
                        style="width: 100%; padding: 10px; border: 4px solid var(--dark); font-family: 'VT323'; font-size: 20px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 5px;">SECRET_KEY:</label>
                    <input type="password" name="password" placeholder="Min 8 karakter" required
                        style="width: 100%; padding: 10px; border: 4px solid var(--dark); font-family: 'VT323'; font-size: 20px;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 5px;">STARTING_GOLD (SALDO):</label>
                    <input type="number" name="saldo" value="0" step="0.01"
                        style="width: 100%; padding: 10px; border: 4px solid var(--dark); font-family: 'VT323'; font-size: 20px; color: #b8860b; font-weight: bold;">
                </div>

                <div style="background: #f0f0f0; padding: 10px; border: 4px dashed var(--dark); margin: 10px 0;">
                    <p style="font-size: 14px; margin: 0; color: #444;">SYSTEM NOTE:</p>
                    <p style="font-size: 16px; margin: 5px 0;">Menyiapkan ID_ACCOUNT secara otomatis...</p>
                </div>

                <button type="submit" class="btn-pixel bg-[#4CAF50] text-white w-full py-4 text-sm hover:bg-green-600">
                    START ADVENTURE!
                </button>
            </form>

            <p style="font-size: 18px; margin-top: 25px;">
                Sudah ada save data? <a href="{{ route('login') }}"
                    style="color: var(--primary); text-decoration: none; border-bottom: 2px solid;">LOAD GAME</a>
            </p>
        </section>
    </div>
@endsection
