@extends('layouts.admin.app')
@section('page-title', 'Detail Pengguna')

@section('content')
    <div class="container-fluid py-4">

        {{-- HEADER HALAMAN --}}
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1 fw-bold">Detail Pengguna</h6>
                    <p class="text-xs text-secondary mb-0">Informasi lengkap akun pengguna.</p>
                </div>
                <div>
                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-primary btn-sm mb-0 me-2">
                        <i class="material-icons opacity-10 me-1">edit</i> Edit
                    </a>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm mb-0">
                        <i class="material-icons opacity-10 me-1">arrow_back</i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- KOLOM KIRI: KARTU PROFIL UTAMA --}}
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center pt-5 pb-4">

                        {{-- FOTO PROFIL (AVATAR) --}}
                        <div class="mb-4">
                            @if ($item->avatar)
                                <img src="{{ asset('storage/' . $item->avatar) }}"
                                    class="img-fluid border rounded-circle shadow-sm p-1 bg-white"
                                    style="width: 140px; height: 140px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-gradient-info d-flex align-items-center justify-content-center mx-auto shadow-sm text-white fw-bold"
                                    style="width: 140px; height: 140px; font-size: 3rem;">
                                    {{ substr($item->name, 0, 2) }}
                                </div>
                            @endif
                        </div>

                        {{-- NAMA & ROLE --}}
                        <h4 class="fw-bold text-dark mb-1">{{ $item->name }}</h4>
                        <p class="text-sm text-muted mb-2">
                            @if ($item->role == 'admin')
                                <span class="badge bg-gradient-success">Administrator</span>
                            @else
                                <span class="badge bg-gradient-secondary">Guest</span>
                            @endif
                        </p>

                        {{-- INFO KONTAK --}}
                        <div class="text-start mt-4 px-3">
                            <div class="d-flex align-items-center mb-3">
                                <i class="material-icons text-secondary me-3">email</i>
                                <span class="text-sm text-dark">{{ $item->email }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="material-icons text-secondary me-3">verified_user</i>
                                <span class="text-sm text-dark">Status: Aktif</span>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="material-icons text-secondary me-3">schedule</i>
                                <span class="text-sm text-dark">
                                    Join: {{ $item->created_at->translatedFormat('d F Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: DETAIL INFORMASI --}}
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0 fw-bold">Informasi Akun</h6>
                    </div>
                    <div class="card-body p-3">

                        {{-- MENGGUNAKAN STYLE 'VISI' UNTUK INFO KEAMANAN --}}
                        <div class="alert alert-light border-start border-4 border-primary bg-gray-100 mb-4">
                            <strong class="text-primary text-xs text-uppercase d-block mb-1">Keamanan Password</strong>
                            <p class="mb-0 text-dark fst-italic">
                                Password tersimpan dengan aman (terenkripsi). Terakhir diperbarui pada:
                                {{ $item->updated_at->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>

                        {{-- MENGGUNAKAN STYLE 'MISI' UNTUK INFO TAMBAHAN --}}
                        <div class="mb-2">
                            <strong class="text-dark text-xs text-uppercase d-block mb-2">Hak Akses</strong>
                            <div class="text-sm text-dark">
                                <ul>
                                    <li>Dapat mengelola Data Agenda Kegiatan.</li>
                                    <li>Dapat mengelola Galeri & Foto.</li>
                                    <li>Dapat mengelola Profil Instansi.</li>
                                    <li>Dapat menambah dan mengedit User lain.</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
