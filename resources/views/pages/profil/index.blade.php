@extends('layouts.admin.app')
@section('page-title', 'Daftar Profil')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Daftar Profil</h6>
          <a href="{{ route('profil.create') }}" class="btn btn-sm btn-primary">
            <i class="material-icons opacity-10 me-1">add</i> Tambah Profil
          </a>
        </div>

        <!-- V FORM FILTER & SEARCH (RAFIX) -->
        <div class="card-body border-bottom py-3">
            <form action="{{ route('profil.index') }}" method="GET">
                <!-- 1. Hapus 'align-items' dari row -->
                <div class="row g-3">
                    <!-- Search -->
                    <div class="col-md-6">
                        <!-- 2. Tambahkan 'mb-0' -->
                        <div class="input-group input-group-outline mb-0">
                            <label class="form-label">Cari Nama Desa/Kecamatan/Email...</label>
                            <input type="text" class="form-control" id="search" name="search"
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <!-- Filter Provinsi -->
                    <div class="col-md-3">
                        <!-- 2. Tambahkan 'mb-0' -->
                        <div class="input-group input-group-outline mb-0">
                            <select class="form-control" id="provinsi" name="provinsi">
                                <option value="">Semua Provinsi</option>
                                @foreach ($provinsi as $prov)
                                    <option value="{{ $prov }}" {{ request('provinsi') == $prov ? 'selected' : '' }}>
                                        {{ $prov }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Tombol -->
                    <!-- 3. Tambahkan 'd-flex align-items-end' -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="material-icons opacity-10">search</i> Filter
                        </button>
                        <a href="{{ route('profil.index') }}" class="btn btn-secondary">
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
                  <th>Nama Desa</th>
                  <th>Kecamatan</th>
                  <th>Kabupaten</th>
                  <th>Provinsi</th>
                  <th>Telepon</th>
                  <th>Email</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($profils as $index => $profil)
                <tr>
                  <td class="text-center">
                    {{ ($profils->currentPage() - 1) * $profils->perPage() + $index + 1 }}
                  </td>
                  <td>{{ $profil->nama_desa }}</td>
                  <td>{{ $profil->kecamatan }}</td>
                  <td>{{ $profil->kabupaten }}</td>
                  <td>{{ $profil->provinsi }}</td>
                  <td>{{ $profil->telepon }}</td>
                  <td>{{ $profil->email }}</td>
                  <td class="text-center">
                    <a href="{{ route('profil.edit', $profil) }}" class="btn btn-sm btn-warning">
                      <i class="material-icons opacity-10">edit</i> Edit
                    </a>
                    <form action="{{ route('profil.destroy', $profil) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus data ini?')">
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
                  <td colspan="8" class="text-center">Data profil tidak ditemukan.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $profils->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
