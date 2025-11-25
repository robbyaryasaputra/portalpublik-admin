<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';
    protected $primaryKey = 'berita_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kategori_id', 'judul', 'slug', 'isi_html', 'penulis', 'status', 'terbit_at',
    ];

    // Relasi ke Media
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'berita_id')->where('ref_table', 'beritas');
    }

    // Accessor: Ambil 1 Cover Image
    public function getCoverAttribute()
    {
        $m = $this->media()->where('caption', 'cover_image')->first();
        if (!$m) $m = $this->media()->orderBy('sort_order')->first();
        return $m ? $m->file_url : null;
    }

    // BARU: Accessor Ambil Galeri (Banyak Foto)
    public function getGalleryAttribute()
    {
        // Ambil media yang caption-nya 'gallery'
        return $this->media()->where('caption', 'gallery')->orderBy('sort_order')->get();
    }

    public function kategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id', 'kategori_id');
    }

    // Scope Filter & Search (Tetap)
    public function scopeFilter(Builder $query, $request, array $filterableColumns = []): Builder
    {
        if (!$request) return $query;
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) $query->where($column, $request->input($column));
        }
        return $query;
    }

    public function scopeSearch(Builder $query, $request, array $searchableColumns = []): Builder
    {
        if (!$request || !$request->filled('search')) return $query;
        $searchTerm = $request->input('search');
        return $query->where(function (Builder $q) use ($searchTerm, $searchableColumns) {
            foreach ($searchableColumns as $index => $column) {
                if ($index === 0) $q->where($column, 'like', '%' . $searchTerm . '%');
                else $q->orWhere($column, 'like', '%' . $searchTerm . '%');
            }
        });
    }
}