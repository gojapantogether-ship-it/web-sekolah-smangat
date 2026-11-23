<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Information extends Model
{
    protected $table = 'information';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'konten',
        'gambar',
        'is_published',
        'tanggal_publikasi',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'tanggal_publikasi' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($info) {
            if (empty($info->slug)) {
                $slug = Str::slug($info->judul);
                $originalSlug = $slug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$originalSlug}-" . $count++;
                }
                $info->slug = $slug;
            }
            if (empty($info->tanggal_publikasi)) {
                $info->tanggal_publikasi = now()->toDateString();
            }
        });
    }
}
