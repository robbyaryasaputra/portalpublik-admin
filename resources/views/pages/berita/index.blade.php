@extends('layouts.admin.app')

@section('page-title', 'Kelola Berita')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Daftar Berita</h6>
                    <a href="{{ route('berita.create') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons opacity-10 me-1">add</i> Tulis Berita Baru
                    </a>
                </div>

                <!-- V FORM FILTER & SEARCH (RAFIX) -->
                <div class="card-body border-bottom py-3">
                    <form action="{{ route('berita.index') }}" method="GET">
                        <!-- 1. Hapus 'align-items' dari row -->
                        <div class="row g-3">
                            <!-- Search -->
                            <div class="col-md-4">
                                <!-- 2. Tambahkan 'mb-0' -->
                                <div class="input-group input-group-outline mb-0">
                                    <label class="form-label">Cari Judul/Penulis...</label>
                                    <input type="text" class="form-control" id="search" name="search"
                                        value="{{ request('search') }}">
                                </div>
                            </div>

                            <!-- Filter Kategori -->
                            <div class="col-md-3">
                                <!-- 2. Tambahkan 'mb-0' -->
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

                            <!-- Filter Status -->
                            <div class="col-md-2">
                                <!-- 2. Tambahkan 'mb-0' -->
                                <div class="input-group input-group-outline mb-0">
                                    <select class="form-control" id="status" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                            Published
                                        </option>
                                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>
                                            Draft
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <!-- 3. Tambahkan 'd-flex align-items-end' -->
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="material-icons opacity-10">search</i> Filter
                                </button>
                                <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- ^ BATAS AKHIR BLOK FORM -->


                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th class="text-center">Status</th>
                                    <th>Terbit Pada</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ ($items->currentPage() - 1) * $items->perPage() + $index + 1 }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($item->judul, 60) }}</td>
                                        <td>{{ $item->kategoriBerita->nama ?? 'N/A' }}</td>
                                        <td>{{ $item->penulis ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            @if($item->status == 'published')
                                                <span class="badge bg-success">Published</span>
                                            @else
                                                <span class="badge bg-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->terbit_at ? \Carbon\Carbon::parse($item->terbit_at)->format('d M Y H:i') : '-' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('berita.edit', ['beritum' => $item->berita_id]) }}" class="btn btn-sm btn-warning">
                                                <i class="material-icons opacity-10">edit</i> Edit
                                            </a>
                                            <form action="{{ route('berita.destroy', ['beritum' => $item->berita_id]) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus berita ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="material-icons opacity-10">delete</i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada berita.</td>
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
