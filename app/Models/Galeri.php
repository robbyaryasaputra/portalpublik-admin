<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';
    protected $primaryKey = 'galeri_id'; // Sesuai migrasi Anda
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'judul',
        'deskripsi',
    ];

    /**
     * Relasi: Satu Galeri punya BANYAK Foto (di tabel Media)
     */
    public function photos()
    {
        return $this->hasMany(Media::class, 'ref_id', 'galeri_id')
                    ->where('ref_table', 'galeris')
                    ->orderBy('sort_order', 'asc');
    }

    /**
     * Helper: Ambil foto pertama sebagai Sampul Album
     */
    public function getSampulAttribute()
    {
        $firstPhoto = $this->photos()->first();
        return $firstPhoto ? $firstPhoto->file_url : null;
    }
}