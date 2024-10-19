<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TPS extends Model
{
    use HasFactory;
    protected $table = 'tps';
    protected $guarded = ['id'];
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }
    public function keluarga()
    {
        return $this->hasMany(KK::class, 'tps_id');
    }
}
