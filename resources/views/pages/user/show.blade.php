@extends('layouts.admin.app')
@section('page-title', 'Detail Pengguna')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-lg">
                
                {{-- Header --}}
                <div class="card-header bg-gradient-primary border-radius-lg pt-4 pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">
                            <i class="material-icons opacity-10 me-2">person</i> Detail Akun Pengguna
                        </h6>
                        <div>
                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-white mb-0 me-2 text-primary">
                                <i class="material-icons text-sm me-1">edit</i> Edit
                            </a>
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-white mb-0">
                                <i class="material-icons text-sm me-1">arrow_back</i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body px-4 py-5">
                    <div class="row align-items-start">
                        
                        {{-- Kiri: Foto & Info Utama --}}
                        <div class="col-md-5 text-center border-end-md">
                            <div class="position-relative d-inline-block">
                                @if ($item->avatar)
                                    <img src="{{ asset('storage/' . $item->avatar) }}" 
                                         class="img-fluid rounded-circle shadow-lg border border-4 border-white" 
                                         style="width: 180px; height: 180px; object-fit: cover;" alt="foto-profil">
                                @else
                                    <div class="rounded-circle bg-gradient-light d-flex align-items-center justify-content-center mx-auto shadow-lg border border-4 border-white" 
                                         style="width: 180px; height: 180px;">
                                        <i class="material-icons text-secondary" style="font-size: 80px;">person</i>
                                    </div>
                                @endif
                            </div>
                            
                            <h4 class="mt-4 mb-0 fw-bold text-dark">{{ $item->name }}</h4>
                            <p class="text-sm text-muted mb-3">{{ $item->username }}</p>

                            <div class="d-flex justify-content-center gap-2">
                                <span class="badge bg-gradient-primary px-3 shadow-sm">
                                    {{ $item->role ?? 'User' }}
                                </span>
                                <span class="badge bg-gradient-success px-3 shadow-sm">
                                    Aktif
                                </span>
                            </div>
                        </div>

                        {{-- Kanan: Detail Informasi --}}
                        <div class="col-md-7 ps-md-5 mt-4 mt-md-0">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder opacity-7 mb-3">Informasi Akun</h6>
                            
                            <div class="mb-4">
                                <label class="text-xs text-secondary mb-0">Email Address:</label>
                                <p class="text-dark font-weight-bold mb-0">{{ $item->email }}</p>
                            </div>

                            <hr class="horizontal dark my-3">

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder opacity-7 mb-3">Keamanan & Kontak</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm d-flex align-items-center">
                                    <i class="material-icons text-secondary me-2">verified_user</i>
                                    <span class="text-dark">Status Verifikasi: <b class="text-success">Verified</b></span>
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm d-flex align-items-center">
                                    <i class="material-icons text-secondary me-2">event_available</i>
                                    <span class="text-dark">Bergabung Sejak: {{ $item->created_at->format('d M Y') }}</span>
                                </li>
                            </ul>

                             <div class="alert alert-light border border-dashed mt-4 d-flex align-items-center p-2">
                                <i class="material-icons text-info me-2">info</i>
                                <span class="text-xs text-muted">Data ini terakhir diperbarui pada {{ $item->updated_at->translatedFormat('d F Y, H:i') }}</span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection