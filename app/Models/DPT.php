<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DPT extends Model
{
    use HasFactory;
    protected $table = 'dpt';
    protected $guarded = ['id'];
}
