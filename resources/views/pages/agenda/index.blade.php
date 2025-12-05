@extends('layouts.admin.app')
@section('page-title', 'Daftar Agenda')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Daftar Agenda</h6>
                        <a href="{{ route('agenda.create') }}" class="btn btn-sm btn-primary">
                            <i class="material-icons me-1 align-middle" style="font-size: 1.7rem;">add_circle</i> Tambah
                            Agenda
                        </a>
                    </div>

                    {{-- FILTER SECTION (Sama Persis dengan Contoh) --}}
                    <div class="card-body border-bottom py-3">
                        <form action="{{ route('agenda.index') }}" method="GET">
                            <div class="row g-3">
                                {{-- 1. Input Search --}}
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline mb-0">
                                        <label class="form-label">Cari Judul / Lokasi...</label>
                                        <input type="text" class="form-control" id="search" name="search"
                                            value="{{ request('search') }}">
                                    </div>
                                </div>

                                {{-- 2. Dropdown Filter --}}
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline mb-0">
                                        <select class="form-control" id="filter_penyelenggara" name="filter_penyelenggara">
                                            <option value="">Semua Penyelenggara</option>
                                            @foreach ($penyelenggaraList as $p)
                                                <option value="{{ $p }}"
                                                    {{ request('filter_penyelenggara') == $p ? 'selected' : '' }}>
                                                    {{ $p }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- 3. Tombol Cari & Reset --}}
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="material-icons opacity-10">search</i> cari
                                    </button>
                                    @if (request('search') || request('filter_penyelenggara'))
                                        <a href="{{ route('agenda.index') }}" class="btn btn-secondary">
                                            Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- TABEL DATA --}}
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success text-white mb-3">{{ session('success') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NO</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Poster</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Judul Agenda</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Waktu</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Lokasi</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Penyelenggara</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($agendas as $index => $agenda)
                                        <tr>
                                            {{-- Kolom NO --}}
                                            <td class="text-center">
                                                {{ ($agendas->currentPage() - 1) * $agendas->perPage() + $index + 1 }}
                                            </td>

                                            {{-- Kolom Poster (Style Gambar Sama dengan Contoh) --}}
                                            <td class="text-center">
                                                @if ($agenda->poster)
                                                    {{-- Jika Ada Poster --}}
                                                    <a href="{{ asset('storage/' . $agenda->poster) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $agenda->poster) }}" alt="poster"
                                                            class="border-radius-lg border"
                                                            style="width: 50px; height: 50px; object-fit: cover;">
                                                    </a>
                                                @else
                                                    {{-- Jika TIDAK Ada Poster (Gunakan Inisial Warna-Warni seperti contoh) --}}
                                                    @php
                                                        // 1. Buat Inisial dari Judul
                                                        $words = explode(' ', $agenda->judul);
                                                        $initials = '';
                                                        foreach ($words as $key => $word) {
                                                            if ($key < 2) {
                                                                $initials .= strtoupper(substr($word, 0, 1));
                                                            }
                                                        }

                                                        // 2. Pilih Warna Acak Berdasarkan ID
                                                        $colors = [
                                                            'bg-gradient-primary',
                                                            'bg-gradient-success',
                                                            'bg-gradient-info',
                                                            'bg-gradient-danger',
                                                            'bg-gradient-warning',
                                                            'bg-gradient-dark',
                                                        ];
                                                        $randomColor = $colors[$agenda->agenda_id % count($colors)];
                                                    @endphp

                                                    <div class="{{ $randomColor }} d-flex justify-content-center align-items-center mx-auto text-white fw-bold shadow-sm border-radius-lg"
                                                        style="width: 50px; height: 50px; font-size: 18px; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                                                        {{ $initials }}
                                                    </div>
                                                @endif
                                            </td>

                                            {{-- Data Agenda --}}
                                            <td>
                                                <h6 class="mb-0 text-sm text-wrap" style="max-width: 250px;">
                                                    {{ $agenda->judul }}</h6>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $agenda->tanggal_mulai->format('d M Y') }}</p>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $agenda->tanggal_mulai->format('H:i') }} WIB</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0 text-wrap"
                                                    style="max-width: 150px;">{{ $agenda->lokasi ?? '-' }}</p>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-sm bg-gradient-light text-dark border">{{ $agenda->penyelenggara ?? '-' }}</span>
                                            </td>


                                            {{-- 5. AKSI (STYLE BARU SESUAI PERMINTAAN) --}}
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center gap-2">

                                                    {{-- Tombol Detail (Hitam / Dark) --}}
                                                    <a href="{{ route('agenda.show', $agenda->agenda_id) }}"
                                                        class="btn btn-sm btn-outline-dark mb-0 px-3" title="Lihat Detail">
                                                        <i class="material-icons text-sm me-1">visibility</i> Detail
                                                    </a>

                                                    {{-- Tombol Edit (Cyan / Info) --}}
                                                    <a href="{{ route('agenda.edit', $agenda->agenda_id) }}"
                                                        class="btn btn-sm btn-outline-info mb-0 px-3" title="Edit Data">
                                                        <i class="material-icons text-sm me-1">edit</i> Edit
                                                    </a>

                                                    {{-- Tombol Hapus (Merah / Danger) --}}
                                                    <form action="{{ route('agenda.destroy', $agenda->agenda_id) }}"
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
                                            <td colspan="7" class="text-center py-4">Data agenda tidak ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- PAGINATION --}}
                        <div class="mt-3">
                            {{ $agendas->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
