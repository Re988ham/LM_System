<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function scopeGetAllCountries($query)
    {
        return $query->orderBy('name')->chunk(10, function ($countries) {
            foreach ($countries as $country) {
                yield $country;
            }
        });
    }




    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
