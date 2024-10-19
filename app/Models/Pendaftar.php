<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftar extends Model
{
    use HasFactory;
    protected $table = 'pendaftar';

    public $incrementing = false;

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    public function dibawai()
    {
        return $this->belongsTo(Pendaftar::class, 'pendaftar_id');
    }


    public function user()
    {
        return $this->hasOne(User::class, 'pendaftar_id');
    }
}
