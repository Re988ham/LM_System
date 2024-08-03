<?php

namespace App\Models;

use App\Enums\ContentStatus;
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

    protected $casts = [
        'status' => ContentStatus::class,
    ];

    public function changeStatus(ContentStatus $newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
