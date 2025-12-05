@extends('layouts.admin.app')
@section('page-title', 'Detail Kategori Berita')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-1 fw-bold text-dark">Detail Kategori Berita</h6>
                <p class="text-xs text-secondary mb-0">Informasi lengkap kategori berita.</p>
            </div>
            <div>
                {{-- Tombol Edit --}}
                <a href="{{ route('kategori-berita.edit', $item->kategori_id) }}" class="btn btn-primary btn-sm mb-0 me-2">
                    <i class="material-icons opacity-10 me-1">edit</i> Edit
                </a>
                {{-- Tombol Kembali --}}
                <a href="{{ route('kategori-berita.index') }}" class="btn btn-secondary btn-sm mb-0 shadow-sm">
                    <i class="material-icons opacity-10 me-1">arrow_back</i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Kolom Kiri: Ikon & Meta Data --}}
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body p-3 text-center">
                    
                    {{-- Ikon Besar sebagai pengganti Cover --}}
                    <div class="bg-gradient-primary border-radius-lg text-center p-5 mb-3 shadow-primary">
                        <i class="material-icons text-white" style="font-size: 64px;">category</i>
                    </div>

                    <h5 class="fw-bold text-dark mt-3">{{ $item->nama }}</h5>
                    <span class="badge bg-light text-dark border mb-4">ID: {{ $item->kategori_id }}</span>

                    <ul class="list-group text-start">
                        <li class="list-group-item border-0 ps-0 text-sm d-flex justify-content-between">
                            <strong class="text-dark">Slug URL:</strong>
                            <span class="text-secondary font-italic">{{ $item->slug }}</span>
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm d-flex justify-content-between">
                            <strong class="text-dark">Dibuat pada:</strong>
                            <span class="text-secondary">{{ $item->created_at->translatedFormat('d F Y') }}</span>
                        </li>
                        <li class="list-group-item border-0 ps-0 text-sm d-flex justify-content-between">
                            <strong class="text-dark">Terakhir update:</strong>
                            <span class="text-secondary">{{ $item->updated_at->diffForHumans() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Deskripsi --}}
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4 h-100">
                <div class="card-header pb-0 d-flex align-items-center">
                    <i class="material-icons text-primary me-2">description</i>
                    <h6 class="fw-bold text-dark mb-0">Deskripsi Kategori</h6>
                </div>
                <div class="card-body">
                    @if($item->deskripsi)
                        <div class="text-dark opacity-8 text-sm" style="line-height: 1.8; text-align: justify;">
                            {!! nl2br(e($item->deskripsi)) !!}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="material-icons text-secondary opacity-5" style="font-size: 48px;">notes</i>
                            <p class="text-sm text-secondary mt-2">Tidak ada deskripsi untuk kategori ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection