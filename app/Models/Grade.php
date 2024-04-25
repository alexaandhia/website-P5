<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'answer_id',
        'grade'
    ];

    public function answer(){
        return $this->belongsTo(Answer::class);
    }


}
