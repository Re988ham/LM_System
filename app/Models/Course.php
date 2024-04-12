<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'specialization_id',
    ];

    public function specialization()
    {
        return $this->belongsToMany(Specialization::class);
    }

    public function element()
    {
        return $this->hasMany(Element::class);
    }
}
