<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if (auth()->user()->level == 0)
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="/dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed " data-bs-target="#master-pegawai" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-folder2-open"></i><span>Master Pegawai</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="master-pegawai"
                    class="nav-content collapse
                @if (Request::is('dashboard/master-pegawai/devisi') || Request::is('dashboard/master-pegawai/data')) show
                @else @endif
                "
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/dashboard/master-pegawai/devisi"
                            class="{{ Request::is('dashboard/master-pegawai/devisi') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>Devisi</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/master-pegawai/data"
                            class="{{ Request::is('dashboard/master-pegawai/data') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>Data Pegawai</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard/qrcode') ? '' : 'collapsed' }}" href="/dashboard/qrcode">
                    <i class="bi bi-qr-code-scan"></i>
                    <span>QrCode</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard/users') ? '' : 'collapsed' }}" href="/dashboard/users">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('dashboard/pengaturan') ? '' : 'collapsed' }}"
                    href="/dashboard/pengaturan">
                    <i class="bi bi-gear"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed " data-bs-target="#laporan" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-text"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="laporan"
                    class="nav-content collapse
                @if (Request::is('dashboard/laporan/harian') || Request::is('dashboard/laporan/bulanan')) show
                @else @endif
                "
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/dashboard/laporan/harian"
                            class="{{ Request::is('dashboard/laporan/harian') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>Harian</span>
                        </a>
                    </li>
                    <li>
                        <a href="/dashboard/laporan/bulanan"
                            class="{{ Request::is('dashboard/laporan/bulanan') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>Bulanan</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (auth()->user()->level == 1)
            {{-- pegawai --}}
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('presensi') ? '' : 'collapsed' }}" href="/presensi">
                    <i class="bi bi-house-door"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ Request::is('presensi/riwayat') ? '' : 'collapsed' }}" href="/presensi/riwayat">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    <span>Riwayat Absensi</span>
                </a>
            </li>
        @endif
    </ul>

</aside>
