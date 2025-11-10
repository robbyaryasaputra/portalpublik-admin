<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    protected $table = 'beritas';
    protected $primaryKey = 'berita_id';
    
    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'isi_html',
        'penulis',
        'status',
        'terbit_at'
    ];

    protected $casts = [
        'terbit_at' => 'datetime',
    ];

    // Relationship dengan KategoriBerita
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id', 'kategori_id');
    }

    // Scope untuk berita yang sudah terbit
    public function scopeTerbit($query)
    {
        return $query->where('status', 'published')
                    ->where('terbit_at', '<=', now())
                    ->orderBy('terbit_at', 'desc');
    }

    // Scope untuk berita draft
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Generate slug dari judul
    public static function boot()
    {
        parent::boot();
        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = \Str::slug($berita->judul);
            }
        });
    }
}