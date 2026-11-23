<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'kategori',
        'jabatan',
        'mata_pelajaran',
        'foto',
        'bio',
    ];
}
