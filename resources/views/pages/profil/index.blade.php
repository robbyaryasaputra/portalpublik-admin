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

        <div class="card-body border-bottom py-3">
            <form action="{{ route('profil.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline mb-0">
                            <label class="form-label">Cari Nama Desa/Kecamatan/Email...</label>
                            <input type="text" class="form-control" id="search" name="search"
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
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
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="material-icons opacity-10">search</i> Filter
                        </button>
                        @if(request('search')|| request('provinsi'))
                            <a href="{{ route('profil.index') }}" class="btn btn-secondary">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success text-white">{{ session('success') }}</div>
          @endif

          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">Logo</th>
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

                  <td class="text-center">
                    @if($profil->logo)
                        {{-- Jika Ada Logo --}}
                        <img src="{{ asset('storage/' . $profil->logo) }}" 
                             alt="logo"
                             class="rounded-circle border"
                             style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        {{-- Jika TIDAK Ada Logo (Gunakan Inisial Warna-Warni) --}}
                        @php
                            // 1. Buat Inisial
                            $words = explode(' ', $profil->nama_desa);
                            $initials = '';
                            foreach($words as $key => $word) {
                                if($key < 2) $initials .= strtoupper(substr($word, 0, 1));
                            }

                            // 2. Pilih Warna Acak Berdasarkan ID (Agar konsisten)
                            $colors = [
                                'bg-gradient-primary', 
                                'bg-gradient-success', 
                                'bg-gradient-info', 
                                'bg-gradient-danger', 
                                'bg-gradient-warning', 
                                'bg-gradient-dark'
                            ];
                            // Rumus: ID modulus Jumlah Warna
                            $randomColor = $colors[$profil->profil_id % count($colors)];
                        @endphp
                        
                        {{-- Tampilkan Lingkaran dengan Warna Acak --}}
                        <div class="rounded-circle {{ $randomColor }} d-flex justify-content-center align-items-center mx-auto text-white fw-bold shadow-sm" 
                             style="width: 50px; height: 50px; font-size: 18px; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                            {{ $initials }}
                        </div>
                    @endif
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
                  <td colspan="9" class="text-center">Data profil tidak ditemukan.</td>
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