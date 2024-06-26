<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function scopeGetAllCountries($query)
    {
        return $query->chunk(10, function ($countries) {
            foreach ($countries as $country) {
                yield $country;
            }
        });
    }




    protected $fillable = [
        'name'
    ];
    protected $hidden=[
        'created_at',
        'updated_at',

    ];


    public function users()
    {

        return $this->hasMany(User::class);
    }
    public function courses()
    {

        return $this->hasMany(Course::class);
    }
}
