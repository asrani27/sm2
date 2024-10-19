<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SM extends Model
{
    use HasFactory;
    protected $table = 'person';
    protected $guarded = ['id'];
    public function rt()
    {
        return $this->belongsTo(RT::class, 'rt_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
