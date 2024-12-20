<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = 'kelurahan';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
    public function tps()
    {
        return $this->hasMany(TPS::class, 'kelurahan_id');
    }

    public function suaratps()
    {
        return $this->hasMany(Suara::class, 'kelurahan_id');
    }
}
