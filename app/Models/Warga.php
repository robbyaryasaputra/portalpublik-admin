<?php

namespace App\Models;

// V 1. Tambahkan 'Builder' untuk Scoping
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'wargas';
    protected $primaryKey = 'warga_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin', // <-- Ini akan kita jadikan filter
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'warga_id')->where('ref_table', 'wargas');
    }
    public function getAvatarAttribute()
    {
        $media = $this->media()->where('caption', 'avatar')->first();
        return $media ? $media->file_url : null;
    }

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
