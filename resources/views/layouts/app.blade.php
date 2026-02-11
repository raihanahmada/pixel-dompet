<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PixelDompet') - Level Up Keuanganmu</title>

    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --bg-color: #E0F8CF;
            --primary: #4CAF50;
            --accent: #FFEB3B;
            --cta: #FF4081;
            --dark: #212529;
            --white: #ffffff;
        }

        /* 1. Tambahkan Keyframes di sini */
        @keyframes scrollBg {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 100px 100px;
            }
        }

        body {
            font-family: 'VT323', monospace;
            color: var(--dark);
            /* 2. Update Body dengan Background Bergerak */
            background-color: #d1ecc0;
            background-image:
                linear-gradient(var(--bg-color) 2px, transparent 2px),
                linear-gradient(90deg, var(--bg-color) 2px, transparent 2px);
            background-size: 40px 40px;
            animation: scrollBg 10s linear infinite;
            margin: 0;
        }

        .pixel-border {
            border: 4px solid var(--dark);
            box-shadow: 6px 6px 0px var(--dark);
        }

        .btn-pixel {
            font-family: 'Press Start 2P', cursive;
            padding: 10px 20px;
            border: 4px solid var(--dark);
            box-shadow: 4px 4px 0px var(--dark);
            transition: all 0.1s;
            text-transform: uppercase;
            font-size: 10px;
        }

        .btn-pixel:active {
            transform: translate(4px, 4px);
            box-shadow: none;
        }

        /* HP Bar Style */
        .hp-bar-container {
            width: 100%;
            height: 20px;
            background: #555;
            border: 3px solid var(--dark);
            position: relative;
            margin-top: 10px;
        }

        .hp-bar-fill {
            height: 100%;
            background: #ff4747;
            /* Warna merah HP */
            transition: width 0.5s ease-in-out;
            border-right: 3px solid var(--dark);
        }

        /* Badge Level */
        .level-badge {
            background: var(--dark);
            color: var(--accent);
            padding: 2px 8px;
            font-size: 14px;
            font-family: 'Press Start 2P', cursive;
        }

        /* Table Style */
        .pixel-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .pixel-table th {
            background: var(--dark);
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .pixel-table td {
            padding: 10px;
            border-bottom: 2px solid var(--dark);
            font-size: 18px;
        }

        .text-income {
            color: #2e7d32;
            font-weight: bold;
        }

        .text-expense {
            color: #c62828;
            font-weight: bold;
        }
    </style>

    @stack('styles')

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
</head>

<body class="min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="container mx-auto px-4 py-10 flex-grow">
        @yield('content')
    </main>

    @include('layouts.footer')
    @include('layouts.action-menu')
    @stack('scripts')
</body>

</html>
