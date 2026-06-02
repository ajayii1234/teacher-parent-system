<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Hash;

class TeacherManagementController extends Controller
{
    public function create()
    {
        $classes = SchoolClass::all();

        return view('teacher.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'class_id' => 'required|exists:school_classes,id',
        ]);

        // CREATE TEACHER
        $teacher = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
        ]);

        // ASSIGN TEACHER TO CLASS
        $class = SchoolClass::find($validated['class_id']);

        $class->teacher_id = $teacher->id;

        $class->save();

        return back()->with('success', 'Teacher created successfully');
    }

    public function index()
{
    $teachers = User::where('role', 'teacher')
        ->with('classTeacher')
        ->get();

    return view('teacher.index', compact('teachers'));
}
}



