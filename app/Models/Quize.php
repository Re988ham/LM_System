<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quize extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'question_number',
        'specialization_id',
        'user_id',
    ];


    public function questions(){

        return $this->hasMany(Question::class);
    }

    public function courses(){

        return $this->belongsToMany(Course::class);
    }
}
