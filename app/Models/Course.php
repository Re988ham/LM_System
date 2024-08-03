<?php

namespace App\Models;

use App\Enums\CourseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'description',
        'specialization_id',
        'country_id',
        'user_id',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => CourseStatus::class,
    ];

    public function changeStatus(CourseStatus $newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function members()
    {
        return $this->belongsToMany(
            User::class,
            "enrollments",
            "course_id",
            "user_id"
        );
    }
}
