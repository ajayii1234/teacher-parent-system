<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'class_id'
    ];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function parents()
    {
        return $this->belongsToMany(User::class, 'parent_student', 'student_id', 'parent_id');
    }

    public function results()
{
    return $this->hasMany(Result::class);
}

public function attendances()
{
    return $this->hasMany(Attendance::class);
}
}
