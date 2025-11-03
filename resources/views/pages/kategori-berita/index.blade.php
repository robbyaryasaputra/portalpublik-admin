@extends('layouts.admin.app')

@section('page-title', 'Kelola Kategori Berita')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Daftar Kategori Berita</h6>

                    <a href="{{ route('kategori-berita.create') }}" class="btn btn-sm btn-primary">
                        <i class="material-icons opacity-10 me-1">add</i> Tambah Kategori
                    </a>
                    </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->kategori_id }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</td>
                                        <td class="text-center">
                                            {{-- Tombol Lihat dihapus --}}
                                            <a href="{{ route('kategori-berita.edit', ['kategori_beritum' => $item->kategori_id]) }}" class="btn btn-sm btn-warning">
                                                <i class="material-icons opacity-10">edit</i> Edit
                                            </a>
                                            <form action="{{ route('kategori-berita.destroy', ['kategori_beritum' => $item->kategori_id]) }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="material-icons opacity-10">delete</i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada kategori.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
