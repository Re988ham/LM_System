<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'question_number',
        'course_id',
        'user_id',
    ];


    public function questions(){

        return $this->hasMany(Question::class);
    }

    public function courses(){

        return $this->belongsToMany(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
