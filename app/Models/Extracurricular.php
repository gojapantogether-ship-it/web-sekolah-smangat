<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $fillable = [
        'nama',
        'pembina',
        'jadwal',
        'deskripsi',
        'foto',
    ];
}
