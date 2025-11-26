@extends('layouts.admin.app')
@section('page-title', 'Detail Profil Desa')

@section('content')
<div class="container-fluid py-4">
    
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-1 fw-bold">Detail Profil Desa</h6>
                <p class="text-xs text-secondary mb-0">Informasi lengkap identitas desa.</p>
            </div>
            <div>
                <a href="{{ route('profil.edit', $profil->profil_id) }}" class="btn btn-primary btn-sm mb-0 me-2">
                <i class="material-icons opacity-10 me-1">edit</i> Edit
                </a>
                <a href="{{ route('profil.index') }}" class="btn btn-secondary btn-sm mb-0"><i class="material-icons opacity-10 me-1">arrow_back</i> Kembali</a>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- KOLOM KIRI --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center pt-5 pb-4">
                    <div class="mb-4">
                        @if($profil->logo)
                            <img src="{{ asset('storage/' . $profil->logo) }}" class="img-fluid border rounded-circle shadow-sm p-1 bg-white" style="width: 140px; height: 140px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-gradient-info d-flex align-items-center justify-content-center mx-auto shadow-sm text-white fw-bold" style="width: 140px; height: 140px; font-size: 3rem;">
                                {{ substr($profil->nama_desa, 0, 2) }}
                            </div>
                        @endif
                    </div>
                    <h4 class="fw-bold text-dark mb-1">{{ $profil->nama_desa }}</h4>
                    <p class="text-sm text-muted mb-2">{{ $profil->kabupaten }}, {{ $profil->provinsi }}</p>
                    
                    <div class="text-start mt-4 px-3">
                         <div class="d-flex align-items-center mb-3">
                            <i class="material-icons text-secondary me-3">email</i>
                            <span class="text-sm text-dark">{{ $profil->email ?? '-' }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="material-icons text-secondary me-3">phone</i>
                            <span class="text-sm text-dark">{{ $profil->telepon ?? '-' }}</span>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="material-icons text-secondary me-3">location_on</i>
                            <span class="text-sm text-dark">{{ $profil->alamat_kantor ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3"><h6 class="mb-0 fw-bold">Visi & Misi</h6></div>
                <div class="card-body p-3">
                    <div class="alert alert-light border-start border-4 border-primary bg-gray-100 mb-4">
                        <strong class="text-primary text-xs text-uppercase d-block mb-1">Visi</strong>
                        <p class="mb-0 text-dark fst-italic fs-5">"{{ $profil->visi ?? 'Belum ada visi.' }}"</p>
                    </div>
                    <div class="mb-2">
                        <strong class="text-dark text-xs text-uppercase d-block mb-2">Misi</strong>
                        <div class="text-sm text-dark" style="white-space: pre-line;">{{ $profil->misi ?? 'Belum ada misi.' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection