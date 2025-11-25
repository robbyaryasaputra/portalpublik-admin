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
            <i class="material-icons opacity-10 me-1">add</i> Tambah Album
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
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Waktu: Terbaru</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Waktu: Terlama</option>
                            </select>
                        </div>
                    </div>

                    {{-- Kolom 3: Tombol Aksi --}}
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="material-icons opacity-10">search</i> Filter
                        </button>
                        @if(request('search') || request('sort'))
                            <a href="{{ route('galeri.index') }}" class="btn btn-secondary">
                                Reset
                            </a>
                        @endif
                    </div>

                </div>
            </form>
        </div>

        {{-- BODY: Tabel Data --}}
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success text-white">{{ session('success') }}</div>
          @endif

          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">Sampul</th>
                  <th>Judul Album</th>
                  <th>Deskripsi Singkat</th>
                  <th class="text-center">Jumlah Foto</th>
                  <th>Dibuat Pada</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($galeris as $index => $item)
                <tr>
                  {{-- NO --}}
                  <td class="text-center">
                    {{ ($galeris->currentPage() - 1) * $galeris->perPage() + $index + 1 }}
                  </td>

                  {{-- SAMPUL (KOTAK / PETAK) --}}
                  <td class="text-center">
                    @if($item->sampul)
                        {{-- Menggunakan 'border-radius-lg' agar kotak --}}
                        <img src="{{ asset('storage/' . $item->sampul) }}" 
                             alt="sampul"
                             class="border-radius-lg border"
                             style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        {{-- Icon Placeholder KOTAK --}}
                        <div class="border-radius-lg bg-gradient-secondary d-flex justify-content-center align-items-center mx-auto text-white shadow-sm" 
                             style="width: 50px; height: 50px;">
                            <i class="material-icons opacity-10">collections</i>
                        </div>
                    @endif
                  </td>

                  {{-- JUDUL --}}
                  <td><h6 class="mb-0 text-sm">{{ $item->judul }}</h6></td>

                  {{-- DESKRIPSI --}}
                  <td><span class="text-xs text-secondary">{{ Str::limit($item->deskripsi, 40) }}</span></td>

                  {{-- JUMLAH FOTO --}}
                  <td class="text-center">
                      <span class="badge badge-sm bg-gradient-info">{{ $item->photos_count }} Foto</span>
                  </td>

                  {{-- TANGGAL --}}
                  <td><span class="text-xs font-weight-bold">{{ $item->created_at->format('d M Y') }}</span></td>

                  {{-- AKSI --}}
                  <td class="text-center">
                    <a href="{{ route('galeri.edit', $item) }}" class="btn btn-sm btn-warning">
                      <i class="material-icons opacity-10">edit</i> Edit
                    </a>
                    <form action="{{ route('galeri.destroy', $item) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus album ini?')">
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
                  <td colspan="7" class="text-center">Data galeri tidak ditemukan.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- PAGINATION --}}
          <div class="mt-3">
            {{ $galeris->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection