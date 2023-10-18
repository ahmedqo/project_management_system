<?php

use App\Models\Client;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/nada', function () {
    //Schema::drop('complaints');
})->name('test');

Route::group(['middleware' => ['check']], function () {
    require __DIR__ . '/auth.php';
});

Route::group(['middleware' => ['auth', 'status']], function () {
    Route::get('/dashboard', function () {
        $days = [
            'Mon' => 0,
            'Tue' => 0,
            'Wed' => 0,
            'Thu' => 0,
            'Fri' => 0,
            'Sat' => 0,
            'Sun' => 0,
        ];

        $tasks = Task::whereBetween('dueDate', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->get(['dueDate'])->groupBy(function ($val) {
            return Carbon::parse($val->dueDate)->format('D');
        });

        foreach ($tasks as $key => $value) {
            $days[$key] = $value->count();
        }

        $progress = [
            'Completed tasks' => Task::whereBetween('dueDate', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ])->where('status', 'closed')->count(),
            'Other tasks' => Task::whereBetween('dueDate', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ])->where('status', '!=', 'hold')->where('status', '!=', 'closed')->count()
        ];

        return view('dashboard', compact('progress', 'days'));
    })->name('views.dashboard');

    Route::get('/notifications/read', function () {
        Notification::where('employee', auth()->user()->id)->update([
            'isRead' => 1
        ]);
    })->name('actions.notifications.read');

    Route::get('/notifications', function () {
        $data = Notification::where('employee', auth()->user()->id)->orderBy('id', 'DESC')->get();
        foreach ($data as $not) {
            $not->update(['isRead' => 1]);
        }
        return view('notification', compact('data'));
    })->name('views.notifications.index');

    require __DIR__ . '/profile.php';
    require __DIR__ . '/employee.php';
    require __DIR__ . '/department.php';
    require __DIR__ . '/termination.php';
    require __DIR__ . '/contract.php';
    require __DIR__ . '/policy.php';
    require __DIR__ . '/account.php';
    require __DIR__ . '/insurance.php';
    require __DIR__ . '/leave.php';
    require __DIR__ . '/client.php';
    require __DIR__ . '/contact.php';
    require __DIR__ . '/project.php';
    require __DIR__ . '/task.php';
    require __DIR__ . '/review.php';
    require __DIR__ . '/complaint.php';
    require __DIR__ . '/expense.php';
    require __DIR__ . '/message.php';
});
