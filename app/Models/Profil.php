<?php

namespace App\Models;

// V 1. Tambahkan 'Builder' untuk Scoping
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

    // ... (Relasi media biarkan apa adanya) ...
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'profil_id')->where('ref_table', 'profils');
    }

    public function getLogoAttribute()
    {
        $m = $this->media()->orderBy('sort_order')->first();
        return $m ? $m->file_url : null;
    }

    // V 2. TAMBAHKAN DUA FUNGSI (SCOPE) DI BAWAH INI

    /**
     * Scope: Filter berdasarkan kolom yang dapat difilter
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns = []): Builder
    {
        if (!$request) {
            return $query;
        }
        foreach ($filterableColumns as $column) {
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
