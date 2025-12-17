@extends('layouts.admin.app')
@section('page-title', 'Daftar Profil Desa')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">

                    {{-- HEADER & TOMBOL TAMBAH --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold">Daftar Profil Desa</h6>
                        <a href="{{ route('profil.create') }}" class="btn btn-sm btn-primary mb-0 ps-2 pe-3">
                            <i class="material-icons me-1 align-middle" style="font-size: 1.7rem;">add_circle</i>
                            <span class="align-middle">Tambah Profil</span>
                        </a>
                    </div>

                    {{-- FILTER & SEARCH --}}
                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('profil.index') }}" method="GET">
                            <div class="row g-3">
                                {{-- Pencarian --}}
                                <div class="col-md-5">
                                    <div class="input-group input-group-outline mb-0">
                                        <label class="form-label">Cari Nama Desa / Email...</label>
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}">
                                    </div>
                                </div>

                                {{-- Filter Provinsi --}}
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline mb-0">
                                        <select class="form-control" name="provinsi">
                                            <option value="">Semua Provinsi</option>
                                            @foreach ($provinsi as $prov)
                                                <option value="{{ $prov }}"
                                                    {{ request('provinsi') == $prov ? 'selected' : '' }}>
                                                    {{ $prov }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Tombol Filter --}}
                                <div class="col-md-4 d-flex align-items-end gap-2">
                                    <button type="submit" class="btn btn-primary mb-0">
                                        <i class="material-icons opacity-10">search</i> Cari
                                    </button>
                                    @if (request('search') || request('provinsi'))
                                        <a href="{{ route('profil.index') }}" class="btn btn-secondary mb-0">
                                            <i class="material-icons text-sm me-1">restart_alt</i>Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">

                        {{-- NOTIFIKASI SUKSES --}}
                        @if (session('success'))
                            <div class="alert alert-success text-white mx-3 mt-3" role="alert">
                                <i class="material-icons text-sm me-2">check_circle</i>
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Identitas Desa</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Lokasi Administratif</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Kontak</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($profils as $index => $item)
                                        <tr>
                                            {{-- 1. NOMOR --}}
                                            <td class="text-center align-middle">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ ($profils->currentPage() - 1) * $profils->perPage() + $index + 1 }}
                                                </span>
                                            </td>

                                            {{-- 2. LOGO & NAMA DESA --}}
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if ($item->logo)
                                                            {{-- KONDISI 1: Jika Ada Logo Uploaded --}}
                                                            <img src="{{ asset('storage/' . $item->logo) }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg border"
                                                                style="object-fit: cover; background: #fff;" alt="logo">
                                                        @else
                                                            {{-- KONDISI 2: Jika TIDAK Ada Logo (Tampilkan Placeholder) --}}
                                                            {{-- Pastikan file gambar tersedia di: public/assets/img/logo-placeholder.jpg --}}

                                                            <img src="{{ asset('assets-admin/img/logos/networking.png') }}"
                                                                class="avatar avatar-sm me-3 border-radius-lg border shadow-sm"
                                                                style="object-fit: cover; opacity: 0.8; background: #f0f2f5;"
                                                                alt="default-logo">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $item->nama_desa }}</h6>
                                                        <p class="text-xs text-secondary mb-0">ID: {{ $item->profil_id }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- 3. LOKASI --}}
                                            <td class="align-middle">
                                                <p class="text-xs font-weight-bold mb-0 text-dark">
                                                    {{ $item->kecamatan ?? '-' }}
                                                </p>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $item->kabupaten }}, {{ $item->provinsi }}
                                                </p>
                                            </td>

                                            {{-- 4. KONTAK --}}
                                            <td class="align-middle">
                                                @if ($item->email)
                                                    <div class="d-flex align-items-center">
                                                        <i class="material-icons text-xs me-1 text-secondary">email</i>
                                                        <span class="text-xs text-secondary">{{ $item->email }}</span>
                                                    </div>
                                                @endif
                                                @if ($item->telepon)
                                                    <div class="d-flex align-items-center mt-1">
                                                        <i class="material-icons text-xs me-1 text-secondary">phone</i>
                                                        <span class="text-xs text-secondary">{{ $item->telepon }}</span>
                                                    </div>
                                                @endif
                                                @if (!$item->email && !$item->telepon)
                                                    <span class="text-xs text-muted fst-italic">- Tidak ada kontak -</span>
                                                @endif
                                            </td>

                                            {{-- 5. AKSI (STYLE BARU SESUAI PERMINTAAN) --}}
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center gap-2">

                                                    {{-- Tombol Detail (Hitam / Dark) --}}
                                                    <a href="{{ route('profil.show', $item->profil_id) }}"
                                                        class="btn btn-sm btn-outline-dark mb-0 px-3" title="Lihat Detail">
                                                        <i class="material-icons text-sm me-1">visibility</i> Detail
                                                    </a>

                                                    {{-- Tombol Edit (Cyan / Info) --}}
                                                    <a href="{{ route('profil.edit', $item->profil_id) }}"
                                                        class="btn btn-sm btn-outline-info mb-0 px-3" title="Edit Data">
                                                        <i class="material-icons text-sm me-1">edit</i> Edit
                                                    </a>

                                                    {{-- Tombol Hapus (Merah / Danger) --}}
                                                    <form action="{{ route('profil.destroy', $item->profil_id) }}"
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
                                            <td colspan="5" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center justify-content-center">
                                                    <i
                                                        class="material-icons opacity-4 text-secondary text-4xl">domain_disabled</i>
                                                    <span class="text-secondary text-sm mt-2">Data profil belum
                                                        tersedia.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- PAGINATION --}}
                        <div class="px-4 py-3 border-top">
                            {{ $profils->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
