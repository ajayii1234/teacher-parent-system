<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'attendance_date',
        'status'
    ];

    // Student relationship
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Teacher relationship
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}