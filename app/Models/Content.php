<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'url',
        'type',
        'status',

    ];


    public function course()
    {
        return $this->belongsToMany(Course::class);
    }

}
