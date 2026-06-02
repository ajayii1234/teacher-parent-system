<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\User;

class StudentController extends Controller
{
    public function create()
{
    $classes = SchoolClass::all();
    $parents = User::where('role', 'parent')->get();

    return view('students.create', compact('classes', 'parents'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'class_id' => 'required',
        'parent_id' => 'required|exists:users,id'
    ]);

    // ✅ CREATE STUDENT
    $student = Student::create([
        'first_name' => $validated['first_name'],
        'last_name' => $validated['last_name'],
        'class_id' => $validated['class_id'],
    ]);

    // ✅ LINK PARENT TO STUDENT (CRITICAL FIX)
    $student->parents()->sync([$validated['parent_id']]);

    return redirect('/students')->with('success', 'Student created successfully');
}

public function index()
{
    $students = Student::with('class', 'parents')->get();
    return view('students.index', compact('students'));
}

public function edit(Student $student)
{
    $classes = SchoolClass::all();
    $parents = User::where('role', 'parent')->get();

    return view('students.edit', compact('student', 'classes', 'parents'));
}

public function update(Request $request, Student $student)
{
    $student->update($request->all());

    $student->parents()->sync($request->parents);

    return redirect('/students')->with('success', 'Updated successfully');
}

public function destroy(Student $student)
{
    $student->delete();
    return back()->with('success', 'Deleted');
}

}
