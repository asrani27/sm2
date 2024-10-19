<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilkada extends Model
{
    use HasFactory;
    protected $table = 'dpt_pilkada';
    protected $guarded = ['id'];
    public function pengumpul()
    {
        return $this->belongsTo(Pengumpul::class, 'pengumpul_id');
    }
}
