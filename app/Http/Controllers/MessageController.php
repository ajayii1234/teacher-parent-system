<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Message;
use App\Models\Alert;

class MessageController extends Controller
{


public function create()
{
    $user = auth()->user();

    if ($user->role === 'parent') {
        $students = $user->children;
        $teachers = User::where('role', 'teacher')->get();

        return view('messages.create', compact('students', 'teachers'));
    }

    if ($user->role === 'teacher') {
        $parents = User::where('role', 'parent')->get();

        return view('messages.create', compact('parents'));
    }
}

public function store(Request $request)
{
    // ✅ VALIDATION
    $validated = $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'nullable',
        'file' => 'nullable|file|max:2048'
    ]);

    // ✅ HANDLE FILE UPLOAD
    $filePath = null;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('messages', 'public');
    }
    
    // ✅ SAVE MESSAGE
    $message = Message::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $validated['receiver_id'],
        'student_id' => $request->student_id ?? null,
        'message' => $validated['message'],
        'file' => $filePath,
    ]);

    // 🔔 CREATE ALERT (NEW MESSAGE NOTIFICATION)
    Alert::create([
        'student_id' => $request->student_id ?? null,
        'user_id' => $validated['receiver_id'],
        'type' => 'message',
        'message' => "📩 You have a new message"
    ]);

    return back()->with('success', 'Message sent successfully');
}

public function index()
{
    $messages = Message::where('receiver_id', auth()->id())
        ->with('sender', 'student')
        ->latest()
        ->get();

    return view('messages.index', compact('messages'));
}

public function chat($userId)
{
    $currentUser = auth()->id();

    $contacts = User::where('id', '!=', $currentUser)
        ->whereIn('role', ['teacher', 'parent'])
        ->get();

    $messages = Message::where(function ($q) use ($userId, $currentUser) {

        $q->where('sender_id', $currentUser)
          ->where('receiver_id', $userId);

    })->orWhere(function ($q) use ($userId, $currentUser) {

        $q->where('sender_id', $userId)
          ->where('receiver_id', $currentUser);

    })
    ->orderBy('created_at')
    ->get();

    Message::where('receiver_id', $currentUser)
        ->where('sender_id', $userId)
        ->update([
            'is_read' => true
        ]);

    $selectedUser = User::findOrFail($userId);

    return view('messages.chat-layout', compact(
        'contacts',
        'messages',
        'selectedUser'
    ));
}

public function chats()
{
    $userId = auth()->id();

    $messages = \App\Models\Message::where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->with(['sender', 'receiver'])
        ->latest()
        ->get();

    $contacts = collect();

    foreach ($messages as $message) {

        $contact = $message->sender_id == $userId
            ? $message->receiver
            : $message->sender;

        $contacts->push($contact);
    }

    $contacts = $contacts->unique('id');

    return view('messages.chats', compact('contacts'));
}

}
