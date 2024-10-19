<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'petugas';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
