<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';
    protected $primaryKey = 'agenda_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'judul',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'penyelenggara',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'agenda_id')->where('ref_table', 'agendas');
    }

    public function getPosterAttribute()
    {
        $m = $this->media()->where('caption', 'poster')->first();
        return $m ? $m->file_url : null;
    }
}