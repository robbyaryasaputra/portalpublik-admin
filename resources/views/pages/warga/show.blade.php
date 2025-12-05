@extends('layouts.admin.app')
@section('page-title', 'Detail Warga')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-lg">
                
                {{-- Header --}}
                <div class="card-header bg-gradient-primary border-radius-lg pt-4 pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3 mb-0">
                            <i class="material-icons opacity-10 me-2">badge</i> Detail Data Warga
                        </h6>
                        <div>
                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn btn-sm btn-white mb-0 me-2 text-primary">
                                <i class="material-icons text-sm me-1">edit</i> Edit
                            </a>
                            <a href="{{ route('warga.index') }}" class="btn btn-sm btn-outline-white mb-0">
                                <i class="material-icons text-sm me-1">arrow_back</i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body px-4 py-5">
                    <div class="row align-items-start">
                        
                        {{-- Kiri: Foto & Info Utama --}}
                        <div class="col-md-4 text-center border-end mb-4 mb-md-0">
                            <div class="position-relative d-inline-block mb-3">
                                @if($item->avatar)
                                    <img src="{{ asset('storage/' . $item->avatar) }}" 
                                         class="rounded-circle img-fluid border border-4 border-white shadow" 
                                         style="width: 180px; height: 180px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-gradient-secondary d-flex align-items-center justify-content-center shadow mx-auto" 
                                         style="width: 180px; height: 180px;">
                                        <span class="text-white fw-bold" style="font-size: 60px;">{{ substr($item->nama, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            <h5 class="font-weight-bolder mb-0">{{ $item->nama }}</h5>
                            <p class="text-muted text-sm mb-2">{{ $item->pekerjaan ?? 'Tidak ada pekerjaan' }}</p>
                            
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <span class="badge bg-gradient-info">{{ $item->jenis_kelamin }}</span>
                                <span class="badge bg-gradient-success">{{ $item->agama ?? '-' }}</span>
                            </div>
                        </div>

                        {{-- Kanan: Detail Lengkap --}}
                        <div class="col-md-8 ps-md-5">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder opacity-7 mb-3">Informasi Kependudukan</h6>
                            
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                    <strong class="text-dark">Nomor Induk Kependudukan (NIK):</strong> <br>
                                    <span class="text-secondary font-weight-normal fs-6">{{ $item->no_ktp }}</span>
                                </li>
                               
                            </ul>

                            <hr class="horizontal dark my-3">

                            <h6 class="text-uppercase text-body text-xs font-weight-bolder opacity-7 mb-3">Kontak & Lainnya</h6>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm d-flex align-items-center">
                                    <i class="material-icons text-secondary me-2">call</i>
                                    <span class="text-dark">{{ $item->telp ?? '-' }}</span>
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm d-flex align-items-center">
                                    <i class="material-icons text-secondary me-2">email</i>
                                    <span class="text-dark">{{ $item->email ?? '-' }}</span>
                                </li>
                            </ul>

                             <div class="alert alert-light border border-dashed mt-4 d-flex align-items-center p-2">
                                <i class="material-icons text-info me-2">info</i>
                                <span class="text-xs text-muted">Data ini terakhir diperbarui pada {{ $item->updated_at->format('d F Y, H:i') }}</span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection