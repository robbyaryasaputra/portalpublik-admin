<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Media; // Pastikan Model Media diimport

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';
    protected $primaryKey = 'berita_id';

    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'isi_html',
        'penulis',
        'status',
        'terbit_at',
    ];

    /**
     * Relasi ke Tabel Kategori
     */
    public function kategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id', 'kategori_id');
    }

    /**
     * Relasi ke Tabel Media
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'berita_id')
                    ->where('ref_table', 'berita')
                    ->orderBy('sort_order', 'asc');
    }

    /**
     * Accessor: Ambil 1 Foto untuk COVER
     * Logika: Cari media dengan caption 'cover_image'. Jika tidak ada, ambil file pertama.
     */
    public function getCoverAttribute()
    {
        $m = $this->media()->where('caption', 'cover_image')->first();
        if (!$m) {
            $m = $this->media()->first();
        }
        return $m ? $m->file_url : null;
    }

    public function getGalleryAttribute()
    {
        return $this->media()->where('caption', 'gallery')->get();
    }

    // --- Scope Filter & Search ---
    public function scopeFilter(Builder $query, $request, array $filterableColumns = []): Builder
    {
        if (!$request) return $query;
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch(Builder $query, $request, array $searchableColumns = []): Builder
    {
        if (!$request || !$request->filled('search')) return $query;
        $searchTerm = $request->input('search');
        return $query->where(function (Builder $q) use ($searchTerm, $searchableColumns) {
            foreach ($searchableColumns as $index => $column) {
                if ($index === 0) {
                    $q->where($column, 'like', '%' . $searchTerm . '%');
                } else {
                    $q->orWhere($column, 'like', '%' . $searchTerm . '%');
                }
            }
        });
    }
}
