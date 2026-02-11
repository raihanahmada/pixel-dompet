@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    <style>
        /* Animasi Baru: Shake */
        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(-1deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            100% {
                transform: translate(1px, 1px) rotate(0deg);
            }
        }

        /* Animasi Baru: Coin Bounce */
        @keyframes coin-pop {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3) translateY(-10px);
            }

            100% {
                transform: scale(1);
            }
        }

        .hero {
            text-align: center;
            padding: 60px 20px;
            background-color: var(--white);
            border: 4px solid var(--dark);
            box-shadow: var(--shadow);
            margin-bottom: 40px;
            overflow: hidden;
            position: relative;
        }

        /* MC-Sprite yang lebih interaktif */
        .mc-sprite {
            font-size: 80px;
            display: inline-block;
            animation: float 3s ease-in-out infinite;
            transition: 0.3s;
            cursor: help;
        }

        .mc-sprite:hover {
            animation: shake 0.5s infinite;
            filter: drop-shadow(0 0 10px var(--accent));
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        /* Card yang bereaksi saat di-hover */
        .card {
            background: var(--white);
            border: 4px solid var(--dark);
            padding: 25px;
            box-shadow: var(--shadow);
            text-align: center;
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card:hover {
            transform: scale(1.05) translateY(-10px);
            background-color: #f9fff2;
            box-shadow: 12px 12px 0px var(--dark);
        }

        .card:hover .icon-box {
            animation: coin-pop 0.6s ease;
        }

        .icon-box {
            display: block;
            font-size: 45px;
            margin-bottom: 15px;
        }

        .coin {
            display: inline-block;
            animation: float 2s ease-in-out infinite;
            color: var(--accent);
        }

        @keyframes walk {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            25% {
                transform: translateY(-5px) rotate(2deg);
            }

            50% {
                transform: translateY(0) rotate(-2deg);
            }

            75% {
                transform: translateY(-5px) rotate(2deg);
            }
        }

        .mc-sprite {
            font-size: 80px;
            display: inline-block;
            animation: walk 0.8s infinite ease-in-out;
            /* Kecepatan jalan */
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .mc-sprite:hover {
            transform: translateX(50px) scale(1.1);
            /* MC bergerak maju saat didekati */
        }
    </style>
@endpush

@section('content')
    <section class="hero">
        <div class="mc-sprite" title="Klik aku untuk Magic!">🧙‍♂️</div>
        <h1 class="pixel-text">GAME OVER UNTUK<br><span style="color: #FF4081;">KEBIASAAN BOROS!</span></h1>
        <p>Kumpulkan <span class="coin" style="animation-delay: 0.2s">🪙</span> Gold dan naikkan level finansialmu.</p>
        <a href="#" class="btn btn-primary">START NEW GAME</a>
    </section>

    <section class="features">
        <div class="card">
            <span class="icon-box">🛡️</span>
            <h3>Shield Mode</h3>
            <p>Pasang perisai agar dompetmu tidak bocor terkena serangan 'Flash Sale'.</p>
        </div>
        <div class="card">
            <span class="icon-box">📜</span>
            <h3>Quest Log</h3>
            <p>Cek ke mana perginya uangmu dalam catatan petualangan harian.</p>
        </div>
        <div class="card">
            <span class="icon-box">📊</span>
            <h3>Stats Page</h3>
            <p>Analisis statistik keuanganmu. Apakah kamu Noob atau Whale?</p>
        </div>
    </section>
@endsection
