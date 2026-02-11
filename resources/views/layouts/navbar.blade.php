<header class="bg-white border-b-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center gap-2">
            <span class="text-2xl">💰</span>
            <a href="/" class="font-['Press_Start_2P'] text-green-600 text-sm md:text-lg">
                PixelDompet
            </a>
        </div>
        <nav class="flex gap-4">
            @guest
                <a href="/login" class="btn-pixel bg-[#4CAF50] text-white">Login</a>
                <a href="/register" class="btn-pixel bg-[#FF4081] text-white">New Game</a>
            @else
                <span class="hidden md:block">PLAYER: {{ Auth::user()->name }}</span>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn-pixel bg-gray-500 text-white">Quit</button>
                </form>
            @endguest
        </nav>
    </div>
</header>
