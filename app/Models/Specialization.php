<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $table = 'specializations';

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'specialization_of_users');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function live()
    {
        return $this->hasMany(Live::class);
    }
}
