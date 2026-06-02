<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Student;

class DashboardController extends Controller
{
    

public function index()
{
    // Average score per student
    $students = Student::with('results')->get();

    $studentPerformance = [];

    foreach ($students as $student) {
        $avg = $student->results->avg('total');

        $studentPerformance[] = [
            'name' => $student->first_name,
            'average' => round($avg, 2)
        ];
    }

    // Detect weak students (avg < 40)
    $weakStudents = collect($studentPerformance)->filter(function ($student) {
        return $student['average'] < 40;
    });

    return view('dashboard.analytics', [
        'studentPerformance' => $studentPerformance,
        'weakStudents' => $weakStudents
    ]);
}
}


