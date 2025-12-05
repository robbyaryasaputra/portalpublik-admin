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
                            <i class="material-icons me-1 align-middle" style="font-size: 1.7rem;">add_circle</i> Tambah Warga
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
                                            <option value="Laki-laki"
                                                {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tombol -->
                                <!-- 3. Tambahkan 'd-flex align-items-end' -->
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="material-icons opacity-10">search</i> Cari
                                    </button>
                                    @if (request('search') || request('jenis_kelamin'))
                                        <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                                            Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- ^ BATAS AKHIR FORM -->

                    <div class="card-body px-0 pb-2">
    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible text-white mx-3 fade show" role="alert">
            <span class="alert-icon align-middle">
              <span class="material-icons text-md">thumb_up</span>
            </span>
            <span class="alert-text"><strong>Berhasil!</strong> {{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        No
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Warga (Foto & Nama)
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIK</th>
                

                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Jenis Kelamin
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        Pekerjaan
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Kontak
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($wargas as $index => $warga)
                    <tr>
                        {{-- NO --}}
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">
                                {{ ($wargas->currentPage() - 1) * $wargas->perPage() + $index + 1 }}
                            </span>
                        </td>

                        {{-- FOTO & NAMA (Digabung agar lebih rapi) --}}
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    @if ($warga->avatar)
                                        <img src="{{ asset('storage/' . $warga->avatar) }}"
                                            class="avatar avatar-sm me-3 border-radius-lg shadow-sm" alt="user1"
                                            style="object-fit: cover;">
                                    @else
                                        <div class="avatar avatar-sm me-3 border-radius-lg bg-gradient-primary shadow-sm d-flex align-items-center justify-content-center">
                                            <span class="text-white text-xs fw-bold">{{ substr($warga->nama, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $warga->nama }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $warga->email ?? 'Belum ada email' }}</p>
                                </div>
                            </div>
                        </td>

                        
                                            <td class="align-middle">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $warga->no_ktp }}</span>
                                            </td>


                        {{-- JENIS KELAMIN (Badge) --}}
                        <td class="align-middle text-center text-sm">
                            @if($warga->jenis_kelamin == 'Laki-laki')
                                <span class="badge badge-sm bg-gradient-info">Laki-laki</span>
                            @else
                                <span class="badge badge-sm bg-gradient-success">Perempuan</span>
                            @endif
                        </td>

                        {{-- PEKERJAAN --}}
                        <td class="align-middle">
                            <span class="text-secondary text-xs font-weight-bold">{{ $warga->pekerjaan ?? '-' }}</span>
                        </td>

                        {{-- KONTAK --}}
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $warga->telp ?? '-' }}</span>
                        </td>
                        
                                                {{-- 5. AKSI (STYLE BARU SESUAI PERMINTAAN) --}}
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center gap-2">

                                                    {{-- Tombol Detail (Hitam / Dark) --}}
                                                    <a href="{{ route('warga.show', $warga) }}"
                                                        class="btn btn-sm btn-outline-dark mb-0 px-3" title="Lihat Detail">
                                                        <i class="material-icons text-sm me-1">visibility</i> Detail
                                                    </a>

                                                    {{-- Tombol Edit (Cyan / Info) --}}
                                                    <a href="{{ route('warga.edit', $warga) }}"
                                                        class="btn btn-sm btn-outline-info mb-0 px-3" title="Edit Data">
                                                        <i class="material-icons text-sm me-1">edit</i> Edit
                                                    </a>

                                                    {{-- Tombol Hapus (Merah / Danger) --}}
                                                    <form action="{{ route('warga.destroy', $warga) }}"
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
