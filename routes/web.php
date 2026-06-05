<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TeacherManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        } elseif ($user->isTeacher()) {
            return redirect('/teacher/dashboard');
        } else {
            return redirect('/parent/dashboard');
        }
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        });
    });

    Route::middleware(['role:teacher'])->group(function () {
        Route::get('/teacher/dashboard', function () {
            return view('teacher.dashboard');
        });
    });

    Route::middleware(['role:parent'])->group(function () {
        Route::get('/parent/dashboard', [ParentController::class, 'dashboard'])
            ->name('parent.dashboard');
    });

    Route::get('/dashboard', function () {
        $user = auth()->user();
    
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        } elseif ($user->isTeacher()) {
            return redirect('/teacher/dashboard');
        } else {
            return redirect('/parent/dashboard');
        }
    })->middleware(['auth'])->name('dashboard');

});

Route::middleware(['auth', 'role:admin,teacher'])->group(function () {
    Route::resource('students', StudentController::class);
});

Route::post(
    '/results/my-class/store',
    [ResultController::class, 'storeClassResult']
)->name('results.class.store');

Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::get(
        '/results/my-class/create',
        [ResultController::class, 'createClassResult']
    )->name('results.class.create');

});

Route::get('/teacher/my-students', [StudentController::class, 'myStudents'])
    ->name('teacher.students');

Route::middleware(['auth', 'role:admin,teacher'])->group(function () {
    Route::resource('results', ResultController::class);
});

Route::middleware(['auth'])->get('/analytics', [DashboardController::class, 'index'])->name('analytics');
Route::middleware(['auth', 'role:parent'])->group(function () {
    Route::get('/parent/results', [ParentController::class, 'results'])->name('parent.results');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('messages', MessageController::class);
    Route::get('/messages/chat/{user}', [MessageController::class, 'chat'])->name('messages.chat');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {

    Route::get('/attendance/create', [AttendanceController::class, 'create'])
        ->name('attendance.create');

    Route::post('/attendance/store', [AttendanceController::class, 'store'])
        ->name('attendance.store');

        Route::get('/attendance', [AttendanceController::class, 'index'])
    ->name('attendance.index');
});

Route::middleware(['auth', 'role:parent'])->group(function () {

    Route::get('/parent/attendance', [ParentController::class, 'attendance'])
        ->name('parent.attendance');

});

Route::get('/notifications/read/{id}', function ($id) {

    $notification = auth()->user()
        ->notifications()
        ->find($id);

    if ($notification) {
        $notification->markAsRead();
    }

    return back();

})->name('notifications.read');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/teachers/create', [TeacherManagementController::class, 'create'])
        ->name('teachers.create');

    Route::post('/teachers/store', [TeacherManagementController::class, 'store'])
        ->name('teachers.store');

        Route::get('/teachers', [TeacherManagementController::class, 'index'])
    ->name('teachers.index');

});

Route::get('/chats', [MessageController::class, 'chats'])
    ->name('chats.index');

    Route::get('/chats', [MessageController::class, 'chats'])
    ->name('chats.index');

    Route::delete('/notifications/{id}', function ($id) {

        $notification = auth()->user()
            ->notifications()
            ->find($id);
    
        if ($notification) {
            $notification->delete();
        }
    
        return redirect()->route('parent.dashboard');
    
    })->name('notifications.delete');

    Route::delete('/alerts/{id}', function ($id) {

        $alert = \App\Models\Alert::where('user_id', auth()->id())
            ->find($id);
    
        if ($alert) {
            $alert->delete();
        }
    
        return redirect()->route('parent.dashboard');
    
    })->name('alerts.delete');


require __DIR__.'/auth.php';
