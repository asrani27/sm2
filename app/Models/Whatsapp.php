<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    use HasFactory;
    protected $table = 'whatsapp';
    protected $guarded = ['id'];
    
    public function riwayat()
    {
        return $this->hasMany(Riwayat::class, 'whatsapp_id');
    }
}
