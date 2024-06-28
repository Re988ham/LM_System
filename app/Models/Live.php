<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'time_start',
        'date_start',
        'code',
        'user_id',
        'specialization_id'
    ];

    public function users(){

        return $this->belongsToMany(User::class);
    }

    public function specialization(){

        return $this->belongsToMany(Specialization::class);
    }

}
