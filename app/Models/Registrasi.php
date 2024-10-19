<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasFactory;
    protected $table = 'registrasi';
    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo(Kategori::class, 'jenis_id');
    }
}
