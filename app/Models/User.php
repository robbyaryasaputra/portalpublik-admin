<?php

namespace App\Models;

// V 1. Tambahkan 'Builder' untuk Scoping
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Media; 

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'id')->where('ref_table', 'users');
    }

    public function getAvatarAttribute()
    {
        // Cari media dengan caption 'avatar'
        $media = $this->media()->where('caption', 'avatar')->first();
        
        // Jika ada, kembalikan URL-nya. Jika tidak, pakai gambar default placeholder
        return $media ? $media->file_url : null;
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
            // Gunakan $request->filled() untuk memastikan nilai tidak kosong
            if ($request->filled($column)) {
                $value = $request->input($column);
                $query->where($column, $value);
            }
        }
        return $query;
    }

    
     // Scope: Search berdasarkan kolom yang dapat dicari
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
