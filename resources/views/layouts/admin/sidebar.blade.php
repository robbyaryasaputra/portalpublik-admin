<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="javascript:void(0)" style="display: flex; align-items: center;">

            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 100 100" fill="none"
                stroke="#e91e63" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"
                style="margin-right: 10px;">
                <circle cx="50" cy="50" r="45" />
                <rect x="30" y="30" width="40" height="40" rx="4" />
                <line x1="50" y1="20" x2="50" y2="80" />
                <line x1="20" y1="50" x2="80" y2="50" />
                <path d="M 30 50 L 30 30 L 50 30" stroke-width="6" />
                <path d="M 70 50 L 70 30 L 50 30" stroke-width="6" />
                <path d="M 30 50 L 30 70 L 50 70" stroke-width="6" />
                <path d="M 70 50 L 70 70 L 50 70" stroke-width="6" />
            </svg>
            <span class="ms-1 font-weight-bold text-white">Portal Publik</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('dashboard.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('dashboard.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Fitur Utama</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('profil.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('profil.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">account_box</i>
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('agenda.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('agenda.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- Icon Kalender --}}
                        <i class="material-icons opacity-10">event</i>
                    </div>
                    <span class="nav-link-text ms-1">Agenda</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('kategori-berita.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('kategori-berita.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">category</i>
                    </div>
                    <span class="nav-link-text ms-1">Kategori Berita</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('berita.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('berita.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">newspaper</i>
                    </div>
                    <span class="nav-link-text ms-1">Berita</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('galeri.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('galeri.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        {{-- Icon Tumpukan Foto --}}
                        <i class="material-icons opacity-10">collections</i>
                    </div>
                    <span class="nav-link-text ms-1">Galeri</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Master Data</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('user.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('user.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">User</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('warga.*') ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('warga.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <span class="nav-link-text ms-1">Warga</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            {{-- Menggunakan Form POST untuk keamanan --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn bg-gradient-primary mt-4 w-100">
                    logout
                </button>
            </form>
        </div>
    </div>
</aside>
