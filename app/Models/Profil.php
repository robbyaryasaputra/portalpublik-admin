<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Media; 

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils';
    protected $primaryKey = 'profil_id'; 
    
    protected $fillable = [
        'nama_desa', 'kecamatan', 'kabupaten', 'provinsi',
        'alamat_kantor', 'email', 'telepon', 'visi', 'misi',
    ];

    /**
     * Relasi ke Tabel Media (Untuk Logo)
     */
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'profil_id')
                    ->where('ref_table', 'profils');
    }

    /**
     * Accessor: Ambil Logo (Prioritas: Caption 'logo' -> File Pertama)
     */
    public function getLogoAttribute()
    {
        $m = $this->media()->where('caption', 'logo')->first();
        if (!$m) {
            $m = $this->media()->first();
        }
        return $m ? $m->file_url : null;
    }

    // Scope Pencarian Sederhana
    public function scopeSearch(Builder $query, $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('nama_desa', 'like', "%{$term}%")
              ->orWhere('kecamatan', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%");
        });
    }
}