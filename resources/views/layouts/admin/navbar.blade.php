<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            @php
                // Ambil judul jika view child meng-set section('page-title')
                $titleFromSection = trim(\Illuminate\Support\Facades\View::getSection('page-title'));
                if ($titleFromSection) {
                    $pageTitle = $titleFromSection;
                } else {
                    // Fallback: gunakan route name yang diformat (mis. warga.index -> Warga Index)
                    $routeName = \Illuminate\Support\Facades\Route::currentRouteName();
                    if ($routeName) {
                        $pageTitle = ucwords(str_replace(['.', '-', '_'], [' ', ' ', ' '], $routeName));
                    } else {
                        $pageTitle = 'Dashboard';
                    }
                }
            @endphp
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $pageTitle }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ $pageTitle }}</h6>
        </nav>

        <ul class="navbar-nav justify-content-end">
            @auth
                <li class="nav-item d-flex align-items-center dropdown pe-2">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        @php
                            $avatarMedia = Auth::user()->media->where('caption', 'avatar')->first();
                            $avatarUrl = $avatarMedia
                                ? asset('storage/' . $avatarMedia->file_url)
                                : 'https://ui-avatars.com/api/?name=' .
                                    urlencode(Auth::user()->name) .
                                    '&background=random';
                        @endphp

                        <img src="{{ $avatarUrl }}" class="avatar avatar-sm rounded-circle me-1" alt="user image">
                        <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="userDropdown">

                        <li class="mb-2">

                            <a class="dropdown-item border-radius-md" href="{{ route('user.edit', auth()->user()->id) }}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">

                                        <i class="material-icons me-2">account_circle</i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            My Profile
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>





                        <li class="mb-2">
                            <div class="dropdown-item border-radius-md" style="cursor: default; pointer-events: none;">
                                <div class="d-flex py-1 align-items-center">
                                    <i class="material-icons me-2 text-secondary" style="font-size: 1.2rem;">history</i>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-0">
                                            {{ session('last_login') ?? \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString() }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <hr class="horizontal dark my-2">

                        <li>
                            <form action="{{ route('logout') }}" method="POST"style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item border-radius-md text-danger">
                                    <div class="d-flex py-1 align-items-center">
                                        <i class="material-icons me-2 text-danger" style="font-size: 1.2rem;">logout</i>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-bold mb-0 text-danger">
                                                Logout
                                            </h6>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth

            @guest
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('login.form') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign In</span>
                    </a>
                </li>
            @endguest

            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </li>

            <li class="nav-item px-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0">
                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                </a>
            </li>

        </ul>
    </div>
    </div>
</nav>
