<?php

namespace App\Models;

// V 1. Tambahkan 'Builder' untuk Scoping
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $table = 'kategori_beritas';
    protected $primaryKey = 'kategori_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
    ];


    // V 2. TAMBAHKAN FUNGSI SCOPE UNTUK FILTER
    /**
     * Scope: Filter berdasarkan kolom yang dapat difilter
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns = []): Builder
    {
        if (!$request) {
            return $query;
        }

        foreach ($filterableColumns as $column) {
            // Gunakan $request->filled() untuk memastikan nilai tidak kosong
            if ($request->filled($column)) {
                $value = $request->input($column);
                $query->where($column, $value);
            }
        }
        return $query;
    }

    // V 3. TAMBAHKAN FUNGSI SCOPE UNTUK SEARCH
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
