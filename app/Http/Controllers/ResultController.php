<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Result;
use App\Models\Student;
use App\Notifications\ResultUploadedNotification;
class ResultController extends Controller
{
    public function create()
{
    $students = \App\Models\Student::all();
    $subjects = \App\Models\Subject::all();

    return view('results.create', compact('students', 'subjects'));
}


public function store(Request $request)
{
    // ✅ VALIDATION
    $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'subject_id' => 'required|exists:subjects,id',
        'ca_score' => 'required|integer|min:0|max:40',
        'exam_score' => 'required|integer|min:0|max:60',
        'term' => 'required',
        'session' => 'required'
    ]);

    // ✅ CALCULATE TOTAL
    $total = $validated['ca_score'] + $validated['exam_score'];

    // ✅ DETERMINE GRADE
    if ($total >= 70) $grade = 'A';
    elseif ($total >= 60) $grade = 'B';
    elseif ($total >= 50) $grade = 'C';
    elseif ($total >= 45) $grade = 'D';
    elseif ($total >= 40) $grade = 'E';
    else $grade = 'F';

    // ✅ SAVE RESULT
    $result = Result::create([
        'student_id' => $validated['student_id'],
        'subject_id' => $validated['subject_id'],
        'ca_score' => $validated['ca_score'],
        'exam_score' => $validated['exam_score'],
        'total' => $total,
        'grade' => $grade,
        'term' => $validated['term'],
        'session' => $validated['session'],
    ]);

    // ✅ GET STUDENT + PARENTS
    $student = Student::with('parents')->find($validated['student_id']);

    if ($student && $student->parents) {

        foreach ($student->parents as $parent) {

            // 🔥 LOW SCORE ALERT
            if ($total < 40) {
                Alert::create([
                    'student_id' => $student->id,
                    'user_id' => $parent->id,
                    'type' => 'low_score',
                    'message' => "⚠ Your child {$student->first_name} scored {$total} in {$result->subject->name}. Immediate attention is required."
                ]);
            }

            // 🔔 NEW RESULT ALERT
            Alert::create([
                'student_id' => $student->id,
                'user_id' => $parent->id,
                'type' => 'new_result',
                'message' => "📊 New result has been uploaded for {$student->first_name} in {$result->subject->name}."
            ]);

            foreach ($student->parents as $parent) {

                $parent->notify(
                    new ResultUploadedNotification(
                        $student,
                        $result->subject->name,
                        $total,
                        $grade
                    )
                );
            }

            // 📩 OPTIONAL: SIMULATED SMS/EMAIL LOG
            \Log::info("Notification sent to {$parent->email}: Result uploaded for {$student->first_name}");
        }
    }

    return back()->with('success', 'Result added successfully');
}

}
