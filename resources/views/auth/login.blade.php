@extends('layouts.app')

@section('title', 'Continue Game - Login')

@push('styles')
<style>
    /* Animasi khusus input fokus untuk Login */
    input:focus {
        background-color: #e3f2fd !important; /* Warna biru muda ala UI Load Game */
        border-color: var(--primary) !important;
        outline: none;
        transform: translateX(5px); /* Sedikit bergeser saat aktif */
        transition: all 0.2s ease;
    }

    .hero-login {
        background: white;
        padding: 40px 20px;
        border: 4px solid var(--dark);
        box-shadow: var(--shadow);
        text-align: center;
    }
</style>
@endpush

@section('content')
<div class="mx-auto" style="max-width: 500px;">

    <div class="alert-container" style="margin-bottom: 20px; text-align: left; font-family: 'VT323', monospace;">
        @if (session('success'))
            <div style="background: #eaffd0; border: 4px solid var(--primary); padding: 15px; box-shadow: 4px 4px 0px var(--dark); display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 25px;">💾</span>
                <div>
                    <strong style="display: block; font-family: 'Press Start 2P'; font-size: 10px; color: var(--primary);">DATA LOADED!</strong>
                    <span style="font-size: 18px;">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div style="background: #ffe5e5; border: 4px solid #ff4081; padding: 15px; box-shadow: 4px 4px 0px var(--dark);">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <span style="font-size: 25px;">🚫</span>
                    <strong style="font-family: 'Press Start 2P'; font-size: 10px; color: #ff4081;">ACCESS DENIED!</strong>
                </div>
                <ul style="font-size: 18px; list-style: none; padding: 0; margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <section class="hero-login">
        <h2 style="font-size: 18px; margin-bottom: 30px;">CONTINUE GAME</h2>

        <form action="{{ route('login.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 20px; text-align: left;">
            @csrf

            <div>
                <label style="display: block; margin-bottom: 8px;">PLAYER_EMAIL:</label>
                <input type="email" name="email" placeholder="Masukkan Email..." required
                    style="width: 100%; padding: 12px; border: 4px solid var(--dark); font-family: 'VT323'; font-size: 20px;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px;">PASS_CODE:</label>
                <input type="password" name="password" placeholder="********" required
                    style="width: 100%; padding: 12px; border: 4px solid var(--dark); font-family: 'VT323'; font-size: 20px;">
            </div>

            <div style="background: #f8f9fa; border: 2px dashed #ccc; padding: 10px; font-size: 16px; color: #666;">
                <p style="margin: 0;">💡 Pastikan CAPS LOCK mati, Adventurer!</p>
            </div>

            <button type="submit" class="btn-pixel bg-[#FF4081] text-white w-full py-4 text-sm" style="width: 100%; margin-top: 10px;">
                LOAD SAVE (LOGIN)
            </button>
        </form>

        <p style="font-size: 18px; margin-top: 30px;">
            Belum punya save data? <br>
            <a href="{{ route('register.index') }}" style="color: var(--cta); text-decoration: none; border-bottom: 2px solid;">NEW GAME (DAFTAR)</a>
        </p>
    </section>
</div>
@endsection
