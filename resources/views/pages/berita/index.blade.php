@extends('layouts.admin.app')
@section('page-title', 'Daftar Berita')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Daftar Berita</h6>
                        <a href="{{ route('berita.create') }}" class="btn btn-sm btn-primary">
                            <i class="material-icons me-1 align-middle" style="font-size: 1.7rem;">add_circle</i> Tambah
                            Berita
                        </a>
                    </div>

                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('berita.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="input-group input-group-outline mb-0">
                                        <label class="form-label">Cari Judul/Penulis...</label>
                                        <input type="text" class="form-control" id="search" name="search"
                                            value="{{ request('search') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group input-group-outline mb-0">
                                        <select class="form-control" id="kategori_id" name="kategori_id">
                                            <option value="">Semua Kategori</option>
                                            @foreach ($kategori as $kat)
                                                <option value="{{ $kat->kategori_id }}"
                                                    {{ request('kategori_id') == $kat->kategori_id ? 'selected' : '' }}>
                                                    {{ $kat->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="input-group input-group-outline mb-0">
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="published"
                                                {{ request('status') == 'published' ? 'selected' : '' }}>
                                                Published
                                            </option>
                                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>
                                                Draft
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="material-icons opacity-10">search</i> Cari
                                    </button>
                                    @if (request('search') || request('kategori_id') || request('status'))
                                        <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                                            Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success text-white">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>

                                        {{-- 1. KOLOM COVER DITAMBAHKAN --}}
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Cover</th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Judul Berita</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kategori</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Penulis</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $index => $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($items->currentPage() - 1) * $items->perPage() + $index + 1 }}
                                            </td>

                                            {{-- 2. TAMPILAN GAMBAR KOTAK --}}
<td class="text-center">
    @if ($item->cover)
        {{-- KONDISI 1: Jika Ada Cover Uploaded --}}
        <img src="{{ asset('storage/' . $item->cover) }}" alt="cover"
            class="border-radius-lg border shadow-sm"
            style="width: 50px; height: 50px; object-fit: cover;">
    @else
        {{-- KONDISI 2: Jika TIDAK Ada Cover (Tampilkan Placeholder) --}}
        {{-- Pastikan file gambar tersedia di: public/assets/img/news-placeholder.jpg --}}
        
        <img src="{{ asset('assets-admin/img/illustrations/illustration-signup.jpg') }}" alt="default-cover"
            class="border-radius-lg border shadow-sm"
            style="width: 50px; height: 50px; object-fit: cover; opacity: 0.8;">
    @endif
</td>

                                            <td>
                                                <h6 class="mb-0 text-sm text-wrap" style="max-width: 250px;">
                                                    {{ $item->judul }}</h6>
                                            </td>
                                            <td class="text-xs font-weight-bold">
                                                {{ $item->kategoriBerita ? $item->kategoriBerita->nama : '-' }}
                                            </td>
                                            <td class="text-sm">{{ $item->penulis }}</td>
                                            <td class="text-xs">
                                                @if ($item->status == 'published')
                                                    <span class="badge bg-gradient-success">Published</span>
                                                @else
                                                    <span class="badge bg-gradient-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td class="text-xs">
                                                {{ $item->terbit_at ? \Carbon\Carbon::parse($item->terbit_at)->format('d M Y H:i') : '-' }}
                                            </td>


                                            {{-- 5. AKSI (STYLE BARU SESUAI PERMINTAAN) --}}
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center gap-2">

                                                    {{-- Tombol Detail (Hitam / Dark) --}}
                                                    <a href="{{ route('berita.show', $item->berita_id) }}"
                                                        class="btn btn-sm btn-outline-dark mb-0 px-3" title="Lihat Detail">
                                                        <i class="material-icons text-sm me-1">visibility</i> Detail
                                                    </a>

                                                    {{-- Tombol Edit (Cyan / Info) --}}
                                                    <a href="{{ route('berita.edit', $item->berita_id) }}"
                                                        class="btn btn-sm btn-outline-info mb-0 px-3" title="Edit Data">
                                                        <i class="material-icons text-sm me-1">edit</i> Edit
                                                    </a>

                                                    {{-- Tombol Hapus (Merah / Danger) --}}
                                                    <form action="{{ route('berita.destroy', $item->berita_id) }}"
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
                                            <td colspan="8" class="text-center py-4">Belum ada berita.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $items->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
