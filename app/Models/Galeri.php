<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media; // Pastikan Model Media sudah ada

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';
    protected $primaryKey = 'galeri_id'; // Kunci utama custom
    
    protected $fillable = [
        'judul',
        'deskripsi',
    ];

    /**
     * Relasi: Satu Album punya BANYAK Foto
     * Mengambil data dari tabel 'media' dimana ref_table = 'galeris'
     */
    public function photos()
    {
        return $this->hasMany(Media::class, 'ref_id', 'galeri_id')
                    ->where('ref_table', 'galeris')
                    ->orderBy('sort_order', 'asc');
    }

    /**
     * Accessor: Sampul Album
     * Mengambil foto pertama untuk dijadikan thumbnail di tabel index
     */
    public function getSampulAttribute()
    {
        $first = $this->photos()->first();
        return $first ? $first->file_url : null;
    }
}