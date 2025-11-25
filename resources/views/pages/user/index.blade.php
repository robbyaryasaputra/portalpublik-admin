@extends('layouts.admin.app')

@section('page-title', 'Kelola User')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Daftar User</h6>
          <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">
            <i class="material-icons opacity-10 me-1">person_add</i> Tambah User
          </a>
        </div>

        <!-- V INI ADALAH FORM YANG SUDAH DIPERBAIKI -->
        <div class="card-body border-bottom py-3">
            <form action="{{ route('user.index') }}" method="GET">
                <!-- 1. HAPUS SEMUA 'align-items' DARI 'row' -->
                <div class="row g-3">

                    <!-- Kolom Search -->
                    <div class="col-md-9">
                        <!-- 2. Pastikan 'mb-0' ada di sini untuk hapus margin bawah -->
                        <div class="input-group input-group-outline mb-0">
                            <label class="form-label">Cari Nama/Email...</label>
                            <input type="text" class="form-control" id="search" name="search"
                                value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Kolom Tombol -->
                    <!-- 3. TAMBAHKAN 'd-flex align-items-end' PADA KOLOM INI -->
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="material-icons opacity-10">search</i> Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <!-- ^ BATAS AKHIR FORM -->

        <div class="card-body">
          @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($items as $index => $item)
                <tr>
                  <td class="text-center">
                    {{ ($items->currentPage() - 1) * $items->perPage() + $index + 1 }}
                  </td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                  <td class="text-center">
                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-warning">
                      <i class="material-icons opacity-10">edit</i> Edit
                    </a>
                    <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus user ini?')">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-danger">
                        <i class="material-icons opacity-10">delete</i> Hapus
                      </button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada user.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-3">
            {{ $items->links('pagination::bootstrap-5') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
