@extends('layouts.admin.app')

@section('page-title', 'Dashboard')

@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12">
                <div class="card card-background-mask-dark">
                    <div class="full-background"
                        style="background-image: url('{{ asset('assets-admin/img/ivancik.jpg') }}'); background-position: center;">
                    </div>
                    <div class="card-body text-left p-3">
                        <div class="row">
                            <div class="col-md-8 col-lg-7">

                                <h3 class="text-pink-600 font-weight-bolder"
                                    style="font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.6);">
                                    Haloo, {{ Auth::user()->name ?? 'Admin' }}
                                </h3>
                                <p class="text-pink-600 text-lg" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                                    Selamat datang kembali. Semua sistem telah siap untuk mengelola dan mempublikasikan
                                    konten Anda.
                                </p>

                            </div>
                            <div class="col-md-4 col-lg-5 d-none d-md-block text-center">
                                <img src="{{ asset('assets-admin/img/illustrations/rocket-white.png') }}" alt="rocket"
                                    style="width: 100%; max-width: 150px; margin-top: -20px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">

            <div class="col-lg-3 col-sm-6 mb-4">
                <a href="{{ route('warga.index') }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Warga</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ \App\Models\Warga::count() ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="material-icons-round text-lg opacity-10">groups</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-0 pt-3 border-0">
                                <p class="mb-0 text-sm"><i
                                        class="material-icons-round text-lg opacity-10 me-1">arrow_forward</i> Kelola Warga
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <a href="{{ route('profil.index') }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Profil</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ \App\Models\Profil::count() ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">

                                    <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                                        <i class="material-icons-round text-lg opacity-10">account_balance</i>
                                    </div>

                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-0 pt-3 border-0">
                                <p class="mb-0 text-sm"><i
                                        class="material-icons-round text-lg opacity-10 me-1">arrow_forward</i> Kelola Profil
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <a href="{{ route('kategori-berita.index') }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Kategori Berita</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ \App\Models\KategoriBerita::count() ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">

                                    <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                        <i class="material-icons-round text-lg opacity-10">article</i>
                                    </div>

                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-0 pt-3 border-0">
                                <p class="mb-0 text-sm"><i
                                        class="material-icons-round text-lg opacity-10 me-1">arrow_forward</i> Kelola
                                    Kategori</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <a href="{{ route('user.index') }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">User</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ \App\Models\User::count() ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">

                                    <div class="icon icon-shape bg-gradient-secondary shadow text-center border-radius-md">
                                        <i class="material-icons-round text-lg opacity-10">person</i>
                                    </div>

                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-0 pt-3 border-0">
                                <p class="mb-0 text-sm"><i
                                        class="material-icons-round text-lg opacity-10 me-1">arrow_forward</i> Kelola User
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <a href="{{ route('agenda.index') }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Agenda</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ \App\Models\Agenda::count() ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">

                                    <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                        <i class="material-icons-round text-lg opacity-10">calendar_today</i>
                                    </div>

                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-0 pt-3 border-0">
                                <p class="mb-0 text-sm"><i
                                        class="material-icons-round text-lg opacity-10 me-1">arrow_forward</i> Kelola Agenda
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <a href="{{ route('berita.index') }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Berita</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ \App\Models\Berita::count() ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">

                                    <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                        <i class="material-icons-round text-lg opacity-10">newspaper</i>
                                    </div>

                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-0 pt-3 border-0">
                                <p class="mb-0 text-sm"><i
                                        class="material-icons-round text-lg opacity-10 me-1">arrow_forward</i> Kelola
                                    Berita</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4">
                <a href="{{ route('galeri.index') }}">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Galeri</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{ \App\Models\Galeri::count() ?? 0 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">

                                    <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                        <i class="material-icons-round text-lg opacity-10">collections</i>
                                    </div>

                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-0 pt-3 border-0">
                                <p class="mb-0 text-sm"><i
                                        class="material-icons-round text-lg opacity-10 me-1">arrow_forward</i> Kelola
                                    Galeri</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>




            

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Monitoring Sistem Dasar</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-chart-line text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">Status Sistem</span> untuk pemantauan kesehatan aplikasi
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    <div class="card bg-gradient-primary">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="numbers">
                                                        <p class="text-sm mb-0 text-capitalize font-weight-bold text-white">Ukuran Database</p>
                                                        <h5 class="font-weight-bolder mb-0 text-white">
                                                            {{ number_format(\DB::select('SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb FROM information_schema.tables WHERE table_schema = DATABASE()')[0]->size_mb ?? 0, 2) }} MB
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                        <i class="material-icons-round text-primary">storage</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    <div class="card bg-gradient-danger">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="numbers">
                                                        <p class="text-sm mb-0 text-capitalize font-weight-bold text-white">Error Logs Hari Ini</p>
                                                        <h5 class="font-weight-bolder mb-0 text-white">
                                                            {{ count(\File::glob(storage_path('logs/laravel-'.date('Y-m-d').'.log'))) }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                        <i class="material-icons-round text-danger">error</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    <div class="card bg-gradient-success">
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="numbers">
                                                        <p class="text-sm mb-0 text-capitalize font-weight-bold text-white">File Media</p>
                                                        <h5 class="font-weight-bolder mb-0 text-white">
                                                            {{ count(\File::allFiles(public_path('storage'))) }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                        <i class="material-icons-round text-success">folder</i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Aktivitas Terbaru</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-history text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">Log Aktivitas</span> terbaru dari sistem
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="list-group list-group-flush">
                                @php
                                    $activities = collect();

                                    // Ambil berita terbaru
                                    $beritas = \App\Models\Berita::latest()->take(3)->get()->map(function($item) {
                                        return [
                                            'type' => 'Berita',
                                            'action' => 'ditambahkan',
                                            'title' => $item->judul,
                                            'created_at' => $item->created_at,
                                            'url' => route('berita.show', $item->berita_id)
                                        ];
                                    });

                                    // Ambil agenda terbaru
                                    $agendas = \App\Models\Agenda::latest()->take(3)->get()->map(function($item) {
                                        return [
                                            'type' => 'Agenda',
                                            'action' => 'ditambahkan',
                                            'title' => $item->judul,
                                            'created_at' => $item->created_at,
                                            'url' => route('agenda.show', $item->agenda_id)
                                        ];
                                    });

                                    // Ambil galeri terbaru
                                    $galeris = \App\Models\Galeri::latest()->take(2)->get()->map(function($item) {
                                        return [
                                            'type' => 'Galeri',
                                            'action' => 'diunggah',
                                            'title' => $item->judul ?? 'Gambar',
                                            'created_at' => $item->created_at,
                                            'url' => route('galeri.show', $item->galeri_id)
                                        ];
                                    });

                                    // Gabungkan dan sort berdasarkan created_at
                                    $activities = $activities->merge($beritas)->merge($agendas)->merge($galeris)->sortByDesc('created_at')->take(8);
                                @endphp

                                @forelse($activities as $activity)
                                    <a href="{{ $activity['url'] }}" class="list-group-item list-group-item-action px-0">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape bg-gradient-{{ $activity['type'] == 'Berita' ? 'warning' : ($activity['type'] == 'Agenda' ? 'info' : 'success') }} shadow text-center border-radius-md me-3">
                                                <i class="material-icons-round text-lg opacity-10">{{ $activity['type'] == 'Berita' ? 'article' : ($activity['type'] == 'Agenda' ? 'calendar_today' : 'collections') }}</i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 text-sm font-weight-bold">{{ $activity['type'] }} <span class="text-muted">{{ $activity['action'] }}</span></p>
                                                <p class="mb-0 text-xs text-muted">{{ Str::limit($activity['title'], 50) }}</p>
                                            </div>
                                            <small class="text-muted">{{ $activity['created_at']->diffForHumans() }}</small>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="material-icons-round text-muted" style="font-size: 3rem;">history</i>
                                        <p class="text-muted mt-2">Belum ada aktivitas terbaru.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Kalender Agenda Mendatang</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-calendar-alt text-warning" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">Agenda Mendatang</span> dalam 30 hari ke depan
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="list-group list-group-flush">
                                @php
                                    $upcomingAgendas = \App\Models\Agenda::where('tanggal_mulai', '>=', now())
                                        ->where('tanggal_mulai', '<=', now()->addDays(30))
                                        ->orderBy('tanggal_mulai')
                                        ->take(5)
                                        ->get();
                                @endphp

                                @forelse($upcomingAgendas as $agenda)
                                    <a href="{{ route('agenda.show', $agenda->agenda_id) }}" class="list-group-item list-group-item-action px-0">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md me-3">
                                                <i class="material-icons-round text-lg opacity-10">event</i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="mb-0 text-sm font-weight-bold">{{ $agenda->judul }}</p>
                                                <p class="mb-0 text-xs text-muted">{{ $agenda->lokasi ?? 'Lokasi tidak ditentukan' }}</p>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted d-block">{{ $agenda->tanggal_mulai->format('d M Y') }}</small>
                                                <small class="text-muted">{{ $agenda->tanggal_mulai->format('H:i') }} WIB</small>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="material-icons-round text-muted" style="font-size: 3rem;">event_busy</i>
                                        <p class="text-muted mt-2">Tidak ada agenda mendatang dalam 30 hari.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">

                <div class="col-lg-7 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Galeri Indonesia</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">Contoh Penerapan</span> Gambar Compressed
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner border-radius-lg">

                                    <div class="carousel-item active">
                                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=800&q=80"
                                            class="d-block w-100" alt="Bali Indonesia"
                                            style="object-fit: cover; height: 400px;">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Bali, Indonesia</h5>
                                            <p>Keindahan Pura Ulun Danu Beratan.</p>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <img src="https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=800&q=80"
                                            class="d-block w-100" alt="Jakarta"
                                            style="object-fit: cover; height: 400px;">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Jakarta City</h5>
                                            <p>Pusat bisnis dan pemerintahan.</p>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=800&q=80"
                                            class="d-block w-100" alt="Bromo"
                                            style="object-fit: cover; height: 400px;">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Gunung Bromo</h5>
                                            <p>Pesona alam Jawa Timur.</p>
                                        </div>
                                    </div>

                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="card h-100">
                        <div class="card-header pb-0">
                            <h6>Identitas Pengembang</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ asset('assets-admin/img/team-4.jpg') }}" alt="Admin"
                                    class="rounded-circle p-1 bg-gradient-primary" width="110">

                                <div class="mt-3">
                                    <h4>Robby Arya Saputra</h4>
                                    <p class="text-secondary mb-1">NIM: 2357301119</p>
                                    <p class="text-muted font-size-sm">S1 Sistem Informasi - politeknik Caltex Riau</p>

                                    <button class="btn btn-primary">Follow</button>
                                    <button class="btn btn-outline-primary">Message</button>
                                </div>

                                <div class="mt-3 w-100 text-center">

                                    <div class="d-flex justify-content-center gap-4">

                                        <a href="https://github.com/robbyaryasaputra" target="_blank"
                                            class="text-dark mx-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Github">
                                            <img src="{{ asset('assets-admin/img/logos/github.png') }}"
                                                style="width: 2.5rem; height: 2.5rem;" alt="GitHub Logo">
                                        </a>

                                        <a href="https://id.linkedin.com/in/robby-arya-saputra-undefined-835269394"
                                            target="_blank" class="mx-2" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="LinkedIn">
                                            <img src="{{ asset('assets-admin/img/logos/linkedin.png') }}" alt="LinkedIn"
                                                style="width: 40px; height: 40px;">
                                        </a>

                                        <a href="https://www.instagram.com/rbyy.arya?igsh=MWcwams4ajhzbXNvMw=="
                                            target="_blank" class="mx-2" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Instagram">
                                            <img src="{{ asset('assets-admin/img/logos/instagram.png') }}"
                                                alt="Instagram" style="width: 40px; height: 40px;">
                                        </a>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
