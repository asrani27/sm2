<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDpt extends Model
{
    use HasFactory;
    protected $table = 'file_dpt';
    protected $guarded = ['id'];
    public $timestamps = false;
}
