<?php

namespace App\Models;

// V Tambahkan 'use' untuk Builder
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';
    protected $primaryKey = 'berita_id';
    public $incrementing = true;
    protected $keyType = 'int';

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
     * Mendapatkan kategori berita untuk berita ini.
     */
    public function kategoriBerita()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id', 'kategori_id');
    }

    // V TAMBAHKAN DUA FUNGSI (SCOPE) DI BAWAH INI
    // (Anda bisa salin-tempel dari model Pelanggan.php Anda)

    /**
     * Scope: Filter berdasarkan kolom yang dapat difilter
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns = []): Builder
    {
        if (!$request) {
            return $query;
        }

        foreach ($filterableColumns as $column) {
            // Gunakan $request->filled() untuk memastikan nilai tidak kosong (contoh: '' string kosong)
            if ($request->filled($column)) {
                $value = $request->input($column);
                $query->where($column, $value);
            }
        }
        return $query;
    }

    /**
     * Scope: Search berdasarkan kolom yang dapat dicari
     */
    public function scopeSearch(Builder $query, $request, array $searchableColumns = []): Builder
    {
        if (!$request || !$request->filled('search')) {
            return $query;
        }

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
