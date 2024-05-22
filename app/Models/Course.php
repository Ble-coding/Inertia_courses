<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Episode;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Course extends Model
{
    use HasFactory, Authorizable;

    protected $table = 'courses';
    protected $fillable = ['title', 'description', 'user_id'];

    protected $appends = ['update', 'delete'];


    protected static function booted()
    {
        static::creating(function ($course) {
            $course->user_id = auth()->id();
        });
    }

    public function getUpdateAttribute()
    {
        return $this->can('update-course', $this);
    }

    public function getDeleteAttribute()
    {
        return $this->can('delete-course', $this);
    }


    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
