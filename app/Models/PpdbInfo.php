<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbInfo extends Model
{
    protected $fillable = [
        'judul',
        'tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'persyaratan',
        'link_pendaftaran',
        'is_active',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean',
    ];
}
