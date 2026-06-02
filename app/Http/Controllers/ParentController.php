<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Result;

class ParentController extends Controller
{
    public function dashboard()
    {
        return view('parent.dashboard');
    }

        public function results()
    {
        $parent = auth()->user();

        // Get children of this parent
        $students = $parent->children()->with('results.subject')->get();

        return view('parent.results', compact('students'));
    }

    

public function attendance()
{
    $parent = auth()->user();

    // Get children with attendance + class
    $students = $parent->children()
        ->with([
            'class',
            'attendances'
        ])
        ->get();

    return view('parent.attendance', compact('students'));
}
}