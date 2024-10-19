<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KK extends Model
{
    use HasFactory;
    protected $table = 'kk';
    protected $guarded = ['id'];
    public function tps()
    {
        return $this->belongsTo(TPS::class, 'tps_id');
    }
}
