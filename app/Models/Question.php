<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable =[
        'body',
        'quize_id'
    ];

    public function answer(){

        return $this->hasMany(Answer::class);
    }

    public function quize(){

        return $this->belongsToMany(Quize::class);
    }
}
