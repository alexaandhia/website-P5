<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'materi',
        'lkpd',
        'minggu',
    ];
    public function user(){
        return $this->hasOne(User::class);
    }
}
