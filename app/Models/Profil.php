<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils';
    protected $primaryKey = 'profil_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'alamat_kantor',
        'email',
        'telepon',
        'visi',
        'misi',
    ];

    /**
     * Relasi ke Tabel Media
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'profil_id')->where('ref_table', 'profils');
    }

    /**
     * Ambil SATU foto untuk Logo
     */
    public function getLogoAttribute()
    {
        // Cari yang spesifik caption 'logo'
        $m = $this->media()->where('caption', 'logo')->first();
        
        // Fallback: Jika tidak ada caption logo, ambil file pertama
        if (!$m) {
            $m = $this->media()->orderBy('sort_order')->first();
        }
        return $m ? $m->file_url : null;
    }

    // --- Scope Filter & Search (Tetap Ada) ---
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