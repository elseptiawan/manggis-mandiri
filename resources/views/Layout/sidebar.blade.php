<nav class="sidebar js-sidebar" id="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Manggis Mandiri</span>
        </a>

        <ul class="sidebar-nav">
            @if (auth()->user()->role == 'administrasi' || auth()->user()->role == 'pemiliktoko' || auth()->user()->role == 'pelayantoko' || auth()->user()->role == 'gudang')
            <li class="sidebar-item">
                <a class="sidebar-link" href="/dashboard">
                    <i class="bi bi-bag align-middle" style="font-size: 1.5rem;"></i> <span class="align-middle">Barang</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'administrasi' || auth()->user()->role == 'pemiliktoko' || auth()->user()->role == 'pelayantoko')
            <li class="sidebar-item">
                <a class="sidebar-link" href="/pelanggan">
                    <i class="bi bi-person-fill align-middle" style="font-size: 1.5rem;"></i> <span class="align-middle">Pelanggan</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'administrasi' || auth()->user()->role == 'pemiliktoko')
            <li class="sidebar-item">
                <a class="sidebar-link" href="/karyawan">
                    <i class="bi bi-person-badge-fill align-middle" style="font-size: 1.5rem;"></i> <span class="align-middle">Karyawan</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'administrasi' || auth()->user()->role == 'pemiliktoko' || auth()->user()->role == 'pelayantoko')
            <li class="sidebar-item">
                <a class="sidebar-link" href="/penjualan">
                    <i class="bi bi-coin align-middle" style="font-size: 1.5rem;"></i> <span class="align-middle">Penjualan</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'administrasi' || auth()->user()->role == 'pemiliktoko' || auth()->user()->role == 'pelanggan' || auth()->user()->role == 'pelayantoko')
            <li class="sidebar-item">
                <a class="sidebar-link" href="/piutang">
                    <i class="bi bi-receipt align-middle" style="font-size: 1.5rem;"></i> <span class="align-middle">Piutang</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->role == 'administrasi' || auth()->user()->role == 'pemiliktoko')
            <li class="sidebar-item">
                <a class="sidebar-link" href="/laporan">
                    <i class="bi bi-journals align-middle" style="font-size: 1.5rem;"></i> <span class="align-middle">Laporan</span>
                </a>
            </li>
            @endif

        </ul>
    </div>
</nav>
