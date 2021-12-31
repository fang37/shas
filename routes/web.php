<?php

use App\Models\Attender;
use App\Models\TimeWork;
use App\Models\TimeEntry;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttenderController;
use App\Http\Controllers\TimeWorkController;
use App\Http\Controllers\TimeEntryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    TimeWork::check_schedule();
    $date = request('date');
    $current_time = date('H:i:s', time());
    $current_date = date('Y-m-d', time());
    $time_work = TimeWork::whereDate('date', ($date)??$current_date)->first();

    $attender_counter = TimeEntry::whereDate('time_start', ($date)??$current_date)->count();

    $time_status = "";
    if ($current_time > $time_work->start_at && $current_time < $time_work->end_at){
        $time_status = "Waktu Kerja";
    };
    if($current_time > $time_work->end_at) {
        $time_status = "Waktu Pulang";
    };
    if($current_time < $time_work->start_at){
        $time_status = "Waktu Masuk";
    };

    return view('dashboard', [
        'title' => 'Dashboard',
        'time_status' => $time_status,
        'attender_counter' => $attender_counter,
        'time_work' => $time_work
    ]);
});

Route::get('/attendance', [TimeEntryController::class, 'index']);
Route::post('/attendance', [TimeEntryController::class, 'store']);
Route::get('/attendance/{id}/edit', [TimeEntryController::class, 'edit']);
Route::patch('/attendance/{id}', [TimeEntryController::class, 'update']);

Route::get('/time-work', [TimeWorkController::class, 'index']);
Route::patch('/time-work/{id}', [TimeWorkController::class, 'update']);

Route::get('/employee', [AttenderController::class, 'index']);
Route::post('/employee', [AttenderController::class, 'store']);
Route::get('/employee/create', [AttenderController::class, 'create']);
Route::get('/employee/{attender}/edit', [AttenderController::class, 'edit']);
Route::patch('/employee/{attender}', [AttenderController::class, 'update']);
Route::get('/employee/{attender}', [AttenderController::class, 'show']);
Route::delete('/employee/{attender}', [AttenderController::class, 'destroy'])->name('employee.destroy');

// Route::get('/employee', function () {
//     return view('employee', [
//         'title' => 'Employee List',
//         'employees' => Attender::all()
//     ]);
// });


// Route::get('/employee', function () {
//     return view('employee', [
//         'title' => 'Employee List',
//     ]);
// });