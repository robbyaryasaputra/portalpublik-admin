@extends('layouts.admin.app')
@section('page-title', 'Detail Album Galeri')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            
            {{-- KARTU 1: HEADER & INFO ALBUM --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom">
                    <h6 class="mb-0 fw-bold">
                        <i class="material-icons opacity-10 me-1 text-primary">photo_library</i>
                        Detail Album
                    </h6>
                    <div>
                        {{-- Tombol Edit Album --}}
                        <a href="{{ route('galeri.edit', $galeri->galeri_id) }}" class="btn btn-primary btn-sm mb-0 me-2">
                        <i class="material-icons opacity-10 me-1">edit</i> Edit
                        </a>
                        {{-- Tombol Kembali --}}
                        <a href="{{ route('galeri.index') }}" class="btn btn-secondary btn-sm mb-0">
                            <i class="material-icons opacity-10 me-1">arrow_back</i> Kembali
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- Judul Album --}}
                            <h3 class="fw-bold text-dark mb-2">{{ $galeri->judul }}</h3>
                            
                            {{-- Info Meta (Jumlah Foto & Tanggal) --}}
                            <div class="d-flex align-items-center mb-4 gap-2">
                                <span class="badge bg-gradient-info">
                                    <i class="material-icons text-xs me-1">collections</i>
                                    {{ $galeri->photos->count() }} Foto
                                </span>
                                <span class="badge bg-gradient-light text-dark border">
                                    <i class="material-icons text-xs me-1">calendar_today</i>
                                    Dibuat: {{ $galeri->created_at->format('d F Y') }}
                                </span>
                            </div>

                            {{-- Deskripsi Album --}}
                            @if($galeri->deskripsi)
                                <div class="p-3 border-start border-4 border-info bg-gray-100 border-radius-md">
                                    <h6 class="text-xs text-uppercase text-muted font-weight-bolder mb-1">Deskripsi</h6>
                                    <p class="mb-0 text-sm text-dark opacity-8">
                                        {{ $galeri->deskripsi }}
                                    </p>
                                </div>
                            @else
                                <p class="text-muted text-sm fst-italic">Tidak ada deskripsi untuk album ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- KARTU 2: GRID FOTO --}}
            <div class="card">
                <div class="card-header pb-0">
                    <h6 class="mb-0">Dokumentasi Foto</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @forelse($galeri->photos as $photo)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="card h-100 shadow-sm border card-plain position-relative group-hover">
                                    
                                    {{-- Link: Klik gambar untuk melihat ukuran penuh di tab baru --}}
                                    <a href="{{ asset('storage/' . $photo->file_url) }}" target="_blank" class="d-block overflow-hidden border-radius-lg">
                                        <img src="{{ asset('storage/' . $photo->file_url) }}" 
                                             class="img-fluid w-100" 
                                             style="height: 200px; object-fit: cover; transition: transform 0.3s ease;"
                                             onmouseover="this.style.transform='scale(1.05)'"
                                             onmouseout="this.style.transform='scale(1)'"
                                             alt="{{ $galeri->judul }}">
                                    </a>
                                    
                                    {{-- Caption Kecil --}}
                                    <div class="card-body p-2 text-center bg-gray-50">
                                        <small class="text-xs text-muted">
                                            <i class="material-icons text-xxs me-1">schedule</i>
                                            {{ $photo->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{-- Tampilan Kosong (Empty State) --}}
                            <div class="col-12 text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <i class="material-icons text-secondary opacity-4" style="font-size: 4rem;">image_not_supported</i>
                                    <h6 class="text-secondary mt-3">Belum ada foto.</h6>
                                    <p class="text-sm text-muted">Tambahkan foto untuk melengkapi album ini.</p>
                                    <a href="{{ route('galeri.edit', $galeri->galeri_id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="material-icons opacity-10 me-1">add_photo_alternate</i> Upload Foto
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection