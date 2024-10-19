<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumpul extends Model
{
    use HasFactory;
    protected $table = 'pengumpul';
    protected $guarded = ['id'];


    public function pilkada()
    {
        return $this->hasMany(Pilkada::class, 'pengumpul_id');
    }
}
