@extends('layouts.admin.app')
@section('page-title', 'Daftar Warga')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Daftar Warga</h6>
          <a href="{{ route('warga.create') }}" class="btn btn-sm btn-primary">
            <i class="material-icons opacity-10 me-1">person_add</i> Tambah Warga
          </a>
        </div>

        <!-- V FORM FILTER & SEARCH (RAFIX) -->
        <div class="card-body border-bottom py-3">
            <form action="{{ route('warga.index') }}" method="GET">
                <!-- 1. Hapus 'align-items' dari row -->
                <div class="row g-3">
                    <!-- Search -->
                    <div class="col-md-6">
                        <!-- 2. Tambahkan 'mb-0' -->
                        <div class="input-group input-group-outline mb-0">
                            <label class="form-label">Cari Nama/NIK/Email/Telp...</label>
                            <input type="text" class="form-control" id="search" name="search"
                                value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Filter Jenis Kelamin -->
                    <div class="col-md-3">
                        <!-- 2. Tambahkan 'mb-0' -->
                        <div class="input-group input-group-outline mb-0">
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="">Semua Jenis Kelamin</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
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
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- ^ BATAS AKHIR FORM -->

        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Pekerjaan</th>
                  <th>Telp</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($wargas as $index => $warga)
                <tr>
                  <td class="text-center">
                    {{ ($wargas->currentPage() - 1) * $wargas->perPage() + $index + 1 }}
                  </td>
                  <td>{{ $warga->no_ktp }}</td>
                  <td>{{ $warga->nama }}</td>
                  <td>{{ $warga->jenis_kelamin }}</td>
                  <td>{{ $warga->pekerjaan }}</td>
                  <td>{{ $warga->telp }}</td>
                  <td class="text-center">
                    <a href="{{ route('warga.edit', $warga) }}" class="btn btn-sm btn-warning">
                      <i class="material-icons opacity-10">edit</i> Edit
                    </a>
                    <form action="{{ route('warga.destroy', $warga) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus data?')">
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
                    <td colspan="7" class="text-center">Data warga tidak ditemukan.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $wargas->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
