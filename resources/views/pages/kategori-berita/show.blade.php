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
                    <a href="{{ route('kategori-berita.edit', $item->kategori_id) }}"
                        class="btn btn-primary btn-sm mb-0 me-2">
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
            {{-- KOLOM KIRI: FOKUS PADA IKON PINK --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-radius-xl h-100">
                    <div class="card-body p-4 text-center">
                        <div class="d-flex justify-content-center mb-4">
                            <div class="shadow-primary border-radius-2xl d-flex align-items-center justify-content-center position-relative"
                                style="background: linear-gradient(195deg, #EC407A 0%, #D81B60 100%); width: 90px; height: 90px;display: flex !important; ">
                                <i class="material-icons text-white m-0 p-0"
                                    style="font-size: 42px; line-height: 1; display: flex; align-items: center; justify-content: center;">category</i>
                            </div>
                        </div>

                        <h4 class="fw-bold text-dark mb-1">{{ $item->nama }}</h4>
                        <p class="text-xs font-weight-bold text-uppercase text-secondary ls-1 mb-4">Kategori Berita</p>

                        {{-- Info Ringkas (Tanpa warna ramai) --}}
                        <div class="border-top pt-4">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-sm text-secondary font-weight-bold">ID Kategori</span>
                                <span class="text-sm text-dark font-weight-bolder">#{{ $item->kategori_id }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-sm text-secondary font-weight-bold">Dibuat pada</span>
                                <span
                                    class="text-sm text-dark font-weight-bolder">{{ $item->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-sm text-secondary font-weight-bold">Terakhir Update</span>
                                <span
                                    class="text-sm text-dark font-weight-bolder">{{ $item->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: DESKRIPSI BERSIH --}}
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-radius-xl h-100">
                    <div class="card-header p-4 pb-0 bg-transparent border-0">
                        <div class="d-flex align-items-center">
                            {{-- Ikon Biru Diganti Menjadi Abu-abu Netral Agar Tidak Ramai --}}
                            <div class="icon icon-shape icon-xs bg-gray-200 shadow-none border-radius-md me-3 d-flex align-items-center justify-content-center"
                                style="width: 32px; height: 32px;">
                                <i class="material-icons text-secondary text-sm" style="line-height: 0;">description</i>
                            </div>
                            <h6 class="fw-bold text-dark mb-0">Deskripsi Detail</h6>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        {{-- Area Deskripsi: Tanpa background warna-warni --}}
                        <div class="border-radius-lg border p-4 bg-white shadow-none">
                            @if ($item->deskripsi)
                                <p class="text-dark text-sm mb-0"
                                    style="line-height: 1.8; text-align: justify; color: #444 !important;">
                                    {!! nl2br(e($item->deskripsi)) !!}
                                </p>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-sm text-secondary mb-0 italic">Belum ada deskripsi untuk kategori ini.
                                    </p>
                                </div>
                            @endif
                        </div>

                        {{-- Tips Section: Lebih Bersih & Elegan --}}
                        <div class="mt-4 pt-2">
                            <div class="d-flex align-items-center p-3 border-radius-lg"
                                style="background-color: #f0f7ff; border-left: 4px solid #03a9f4;">
                                <i class="material-icons text-info me-3" style="font-size: 20px;">lightbulb_outline</i>
                                <p class="text-sm text-dark mb-0">
                                    <span class="font-weight-bold text-info">Tips:</span>
                                    Gunakan kategori ini untuk mengelompokkan berita <strong>{{ $item->nama }}</strong>
                                    agar navigasi pembaca menjadi lebih efisien.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
