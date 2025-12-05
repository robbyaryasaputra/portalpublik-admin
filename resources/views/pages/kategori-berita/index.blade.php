@extends('layouts.admin.app')

@section('page-title', 'Kelola Kategori Berita')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Daftar Kategori Berita</h6>
                        <a href="{{ route('kategori-berita.create') }}" class="btn btn-sm btn-primary">
                            <i class="material-icons me-1 align-middle" style="font-size: 1.7rem;">add_circle</i> Tambah
                            Kategori
                        </a>
                    </div>

                    <!-- V FORM SEARCH (RAFIX) -->
                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('kategori-berita.index') }}" method="GET">
                            <!-- 1. Hapus 'align-items' dari row -->
                            <div class="row g-3">
                                <!-- Search -->
                                <div class="col-md-9">
                                    <!-- 2. Tambahkan 'mb-0' -->
                                    <div class="input-group input-group-outline mb-0">
                                        <label class="form-label">Cari Nama/Deskripsi...</label>
                                        <input type="text" class="form-control" id="search" name="search"
                                            value="{{ request('search') }}">
                                    </div>
                                </div>

                                <!-- Tombol -->
                                <!-- 3. Tambahkan 'd-flex align-items-end' -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="material-icons opacity-10">search</i> Cari
                                    </button>
                                    @if (request('search'))
                                        <a href="{{ route('kategori-berita.index') }}" class="btn btn-secondary">
                                            Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- ^ BATAS AKHIR FORM -->


                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th>Nama</th>
                                        <th>Slug</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $index => $item)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($items->currentPage() - 1) * $items->perPage() + $index + 1 }}
                                            </td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</td>
                                                                     {{-- 5. AKSI (STYLE BARU SESUAI PERMINTAAN) --}}
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center gap-2">

                                                    {{-- Tombol Detail (Hitam / Dark) --}}
                                                    <a href="{{ route('kategori-berita.show', $item->kategori_id) }}"
                                                        class="btn btn-sm btn-outline-dark mb-0 px-3" title="Lihat Detail">
                                                        <i class="material-icons text-sm me-1">visibility</i> Detail
                                                    </a>

                                                    {{-- Tombol Edit (Cyan / Info) --}}
                                                    <a href="{{ route('kategori-berita.edit', $item->kategori_id) }}"
                                                        class="btn btn-sm btn-outline-info mb-0 px-3" title="Edit Data">
                                                        <i class="material-icons text-sm me-1">edit</i> Edit
                                                    </a>

                                                    {{-- Tombol Hapus (Merah / Danger) --}}
                                                    <form action="{{ route('kategori-berita.destroy', $item->kategori_id) }}"
                                                        method="POST" style="display:inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus data kategori berita ini?')">
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
                                            <td colspan="5" class="text-center">Belum ada kategori.</td>
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
