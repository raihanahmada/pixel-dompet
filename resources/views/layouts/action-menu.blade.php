<style>
    /* Kontainer utama menu melayang */
    .action-menu-container {
        position: fixed;
        bottom: 2.5rem; /* bottom-10 */
        right: 2.5rem;  /* right-10 */
        display: flex;
        flex-direction: column;
        gap: 1rem;      /* gap-4 */
        z-index: 50;
        /* Efek Transparan saat tidak digunakan */
        opacity: 0.4;
        transform: scale(0.9);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    /* Menjadi terang dan membesar saat di-hover */
    .action-menu-container:hover {
        opacity: 1;
        transform: scale(1);
    }

    /* Styling tambahan untuk label tooltip (span) */
    .action-menu-container .group:hover span {
        display: block;
        animation: fadeIn 0.2s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateX(10px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>

<div class="action-menu-container">
    <button class="btn-pixel bg-red-400 group relative" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Go Up">
        <span class="hidden absolute -left-32 bg-black text-white p-1 text-[10px] border-2 border-white">SCROLL UP</span>
        ⬆️
    </button>

    <a href="{{ route('transaction.show') }}" class="btn-pixel bg-blue-400 group relative" title="View History & Charts">
        <span class="hidden absolute -left-36 bg-black text-white p-1 text-[10px] border-2 border-white">STATS</span>
        📊
    </a>

    <a href="{{ route('dashboard.index') }}" class="btn-pixel bg-yellow-400 group relative" title="Back to Home">
        <span class="hidden absolute -left-32 bg-black text-white p-1 text-[10px] border-2 border-white">HOME BASE</span>
        🏠
    </a>
</div>
