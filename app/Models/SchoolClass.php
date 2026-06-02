<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['name'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}
}