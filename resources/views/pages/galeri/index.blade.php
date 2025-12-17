@extends('layouts.admin.app')
@section('page-title', 'Daftar Galeri')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Daftar Album Galeri</h6>
                        <a href="{{ route('galeri.create') }}" class="btn btn-sm btn-primary">
                            <i class="material-icons me-1 align-middle" style="font-size: 1.7rem;">add_circle</i> Tambah Album
                        </a>
                    </div>

                    {{-- FORM FILTER & PENCARIAN --}}
                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('galeri.index') }}" method="GET">
                            <div class="row g-3">

                                {{-- Kolom 1: Search --}}
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline mb-0">
                                        <label class="form-label">Cari Judul Album...</label>
                                        <input type="text" class="form-control" id="search" name="search"
                                            value="{{ request('search') }}">
                                    </div>
                                </div>

                                {{-- Kolom 2: Sort --}}
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline mb-0">
                                        <select class="form-control" id="sort" name="sort">
                                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                                Waktu: Terbaru</option>
                                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                                Waktu: Terlama</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Kolom 3: Tombol Aksi --}}
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="material-icons opacity-10">search</i> cari
                                    </button>
                                    @if (request('search') || request('sort'))
                                        <a href="{{ route('galeri.index') }}" class="btn btn-secondary">
                                            <i class="material-icons text-sm me-1">restart_alt</i>Reset
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        {{-- ALERT SUCCESS --}}
                        @if (session('success'))
                            <div class="alert alert-success text-white" role="alert">
                                <i class="material-icons text-sm me-2">check_circle</i>
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- BAGIAN TABEL (SUDAH DISESUAIKAN DENGAN GAYA BERITA) --}}
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Cover</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Judul Album</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Deskripsi</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Jumlah Foto</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($galeris as $index => $item)
                                            <tr>
                                                {{-- 1. NOMOR URUT --}}
                                                <td class="text-center align-middle">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ ($galeris->currentPage() - 1) * $galeris->perPage() + $index + 1 }}
                                                    </span>
                                                </td>

                                                {{-- 2. COVER ALBUM --}}
                                                <td class="text-center align-middle">
                                                    @if ($item->sampul)
                                                        {{-- KONDISI 1: Jika Ada Sampul Uploaded --}}
                                                        <img src="{{ asset('storage/' . $item->sampul) }}" alt="cover"
                                                            class="border-radius-lg border shadow-sm"
                                                            style="width: 50px; height: 50px; object-fit: cover;">
                                                    @else
                                                        {{-- KONDISI 2: Jika TIDAK Ada Sampul (Tampilkan Placeholder) --}}
                                                        {{-- Pastikan file gambar tersedia di: public/assets/img/gallery-placeholder.jpg --}}

                                                        <img src="{{ asset('assets-admin/img/logos/galery.png') }}"
                                                            alt="default-cover" class="border-radius-lg border shadow-sm"
                                                            style="width: 50px; height: 50px; object-fit: cover; opacity: 0.8;">
                                                    @endif
                                                </td>

                                                {{-- 3. JUDUL ALBUM --}}
                                                <td class="align-middle">
                                                    <h6 class="mb-0 text-sm text-wrap fw-bold" style="max-width: 200px;">
                                                        {{ $item->judul }}</h6>
                                                </td>

                                                {{-- 4. DESKRIPSI SINGKAT --}}
                                                <td class="align-middle">
                                                    <p class="text-xs text-secondary mb-0 text-wrap"
                                                        style="max-width: 250px;">
                                                        {{ Str::limit($item->deskripsi, 50) ?: '-' }}
                                                    </p>
                                                </td>

                                                {{-- 5. JUMLAH FOTO (BADGE) --}}
                                                <td class="align-middle">
                                                    <span class="badge badge-sm bg-gradient-info">
                                                        {{ $item->photos_count ?? 0 }} Foto
                                                    </span>
                                                </td>

                                                {{-- 6. TANGGAL BUAT --}}
                                                <td class="align-middle">
                                                    <p class="text-xs font-weight-bold mb-0 text-dark">
                                                        {{ $item->created_at->format('d M Y') }}</p>
                                                    <p class="text-xs text-secondary mb-0">
                                                        {{ $item->created_at->format('H:i') }} WIB</p>
                                                </td>


                                                {{-- 5. AKSI (STYLE BARU SESUAI PERMINTAAN) --}}
                                                <td class="text-center align-middle">
                                                    <div class="d-flex justify-content-center gap-2">

                                                        {{-- Tombol Detail (Hitam / Dark) --}}
                                                        <a href="{{ route('galeri.show', $item->galeri_id) }}"
                                                            class="btn btn-sm btn-outline-dark mb-0 px-3"
                                                            title="Lihat Detail">
                                                            <i class="material-icons text-sm me-1">visibility</i> Detail
                                                        </a>

                                                        {{-- Tombol Edit (Cyan / Info) --}}
                                                        <a href="{{ route('galeri.edit', $item->galeri_id) }}"
                                                            class="btn btn-sm btn-outline-info mb-0 px-3" title="Edit Data">
                                                            <i class="material-icons text-sm me-1">edit</i> Edit
                                                        </a>

                                                        {{-- Tombol Hapus (Merah / Danger) --}}
                                                        <form action="{{ route('galeri.destroy', $item->galeri_id) }}"
                                                            method="POST" style="display:inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus data profil desa ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger mb-0 px-3"
                                                                title="Hapus Permanen">
                                                                <i class="material-icons text-sm me-1">delete</i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div
                                                        class="d-flex flex-column align-items-center justify-content-center">
                                                        <i
                                                            class="material-icons opacity-4 text-secondary text-4xl">photo_library</i>
                                                        <span class="text-secondary text-sm mt-2">Belum ada album
                                                            galeri.</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- PAGINATION --}}
                            <div class="px-4 py-3 border-top">
                                {{ $galeris->links('pagination::bootstrap-5') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
