@extends('layouts.admin.app')
@section('page-title', 'Daftar Profil')

@section('content')
<div class="container-fluid py-4">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4>Daftar Profil</h4>

      <a href="{{ route('profil.create') }}" class="btn btn-primary btn-action">
        <i class="material-icons opacity-10 me-1">add</i> Tambah Profil
      </a>
      </div>
    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr><th>Profil ID</th><th>Nama Desa</th><th>Kabupaten</th><th>Aksi</th></tr>
          </thead>
          <tbody>
            @foreach($profils as $profil)
            <tr>
              <td>{{ $profil->profil_id }}</td>
              <td>{{ $profil->nama_desa }}</td>
              <td>{{ $profil->kabupaten }}</td>
              <td>
                {{-- Tombol Lihat dihapus --}}
                <a href="{{ route('profil.edit', $profil) }}" class="btn btn-sm btn-warning">
                  <i class="material-icons opacity-10">edit</i> Edit
                </a>
                <form action="{{ route('profil.destroy', $profil) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus data ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="material-icons opacity-10">delete</i> Hapus
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $profils->links() }}</div>
    </div>
  </div>
</div>
@endsection
