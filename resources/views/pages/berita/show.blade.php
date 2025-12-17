@extends('layouts.admin.app')
@section('page-title', 'Detail Berita')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1 fw-bold text-dark">Detail Berita</h6>
                    <p class="text-xs text-secondary mb-0">Pratinjau konten berita dan galeri.</p>
                </div>
                <div>
                    <a href="{{ route('berita.edit', $berita->berita_id) }}" class="btn btn-primary btn-sm mb-0 me-2">
                        <i class="material-icons opacity-10 me-1">edit</i> Edit
                    </a>
                    <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-sm mb-0 shadow-sm">
                        <i class="material-icons opacity-10 me-1">arrow_back</i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Kolom Kiri: Meta Data & Cover --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-3">
                        @if ($berita->cover)
                            <img src="{{ asset('storage/' . $berita->cover) }}"
                                class="img-fluid border-radius-lg shadow-sm w-100 mb-3" alt="cover">
                        @else
                            <div class="bg-gray-200 border-radius-lg text-center p-5 mb-3">
                                <i class="material-icons text-4xl text-secondary">image_not_supported</i>
                            </div>
                        @endif

                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Penulis:</strong> &nbsp; {{ $berita->penulis }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Kategori:</strong> &nbsp;
                                {{ $berita->kategoriBerita->nama ?? '-' }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Tanggal:</strong> &nbsp;
                                {{ $berita->terbit_at ? \Carbon\Carbon::parse($berita->terbit_at)->format('d F Y') : '-' }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Status:</strong> &nbsp;
                                @if ($berita->status == 'published')
                                    <span class="badge bg-gradient-success">Published</span>
                                @else
                                    <span class="badge bg-gradient-secondary">Draft</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Isi Berita & Galeri --}}
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header pb-0">
                        <h4 class="fw-bold text-dark">{{ $berita->judul }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-dark opacity-8 text-sm" style="line-height: 1.8; text-align: justify;">
                            {!! nl2br(e($berita->isi_html)) !!}
                        </div>
                    </div>
                </div>

                {{-- Galeri --}}
                @if ($berita->gallery->count() > 0)
                    <div class="card shadow-sm">
                        <div class="card-header pb-0">
                            <h6 class="fw-bold">Galeri Dokumentasi</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach ($berita->gallery as $gal)
                                    <div class="col-6 col-md-3">
                                        {{-- Tambahkan class 'd-block' dan 'overflow-hidden' agar zoom tidak keluar kotak --}}
                                        <a href="{{ asset('storage/' . $gal->file_url) }}" target="_blank"
                                            class="d-block border-radius-lg overflow-hidden shadow-sm">
                                            <img src="{{ asset('storage/' . $gal->file_url) }}"
                                                class="img-fluid w-100 img-hover-zoom"
                                                style="height: 120px; object-fit: cover; transition: all 0.3s ease;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
