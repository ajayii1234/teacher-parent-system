<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\Student;
use App\Notifications\StudentAbsentNotification;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
 
    public function create()
    {
        $teacher = auth()->user();
    
        $class = $teacher->classTeacher;
    
        if (!$class) {
    
            return view('attendance.create', [
                'class' => null,
                'students' => collect(),
            ]);
    
        }
    
        $students = Student::where('class_id', $class->id)->get();
    
        return view('attendance.create', compact('students', 'class'));
    }

public function store(Request $request)
{
    foreach ($request->attendance as $studentId => $status) {

        // Prevent duplicate attendance same day
        $exists = Attendance::where('student_id', $studentId)
            ->whereDate('attendance_date', now())
            ->exists();

        if (!$exists) {

            Attendance::create([
                'student_id' => $studentId,
                'teacher_id' => auth()->id(),
                'attendance_date' => now(),
                'status' => $status
            ]);

            if ($status == 'absent') {

                $student = Student::with('parents')->find($studentId);
            
                foreach ($student->parents as $parent) {
            
                    $parent->notify(
                        new StudentAbsentNotification(
                            $student,
                            now()->toDateString()
                        )
                    );
                }
            }
        }
    }

    return back()->with('success', 'Attendance marked successfully');
}


public function index()
{
    $teacher = auth()->user();

    // Get teacher class
    $class = $teacher->classTeacher;

    // Teacher has no class assigned
    if (!$class) {

        return view('attendance.index', [
            'class' => null,
            'attendances' => collect(),
        ]);

    }

    // Fetch attendance for students in teacher class
    $attendances = Attendance::with('student.class')
        ->whereHas('student', function ($query) use ($class) {

            $query->where('class_id', $class->id);

        })
        ->latest()
        ->get();

    return view('attendance.index', compact(
        'attendances',
        'class'
    ));
}

}
