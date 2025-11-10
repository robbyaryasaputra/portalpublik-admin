@extends('layouts.admin.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berita</h1>
        <a href="{{ route('berita.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm text-white-50 me-2"></i>Tambah Berita
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tanggal Terbit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beritas as $index => $berita)
                            <tr>
                                <td>{{ $beritas->firstItem() + $index }}</td>
                                <td>{{ $berita->judul }}</td>
                                <td>{{ $berita->kategori->nama }}</td>
                                <td>
                                    @if($berita->status === 'published')
                                        <span class="badge bg-success">Dipublikasi</span>
                                    @else
                                        <span class="badge bg-warning">Draft</span>
                                    @endif
                                </td>
                                <td>{{ $berita->terbit_at ? $berita->terbit_at->format('d/m/Y H:i') : '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('berita.edit', $berita) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('berita.destroy', $berita) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus berita ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $beritas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
