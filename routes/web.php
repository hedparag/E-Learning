<?php

use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\studentDashboardController;
use App\Http\Controllers\Frontend\teacherDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>['auth:web','verified','checkRole:student'],'prefix'=>'student','as'=>'student.'],function(){
Route::get('/dashboard', [studentDashboardController::class,'index'])->name('dashboard');
Route::get('becomeInstructor/{id}',[studentDashboardController::class,'becomeInstructor'])->name('become-instructor');
Route::post('becomeInstructorStore/{id}',[studentDashboardController::class,'store'])->name('become-instructor-store');

});

Route::group(['middleware'=>['auth:web','verified','checkRole:teacher'],'prefix'=>'teacher','as'=>'teacher.'],function(){
Route::get('/dashboard', [teacherDashboardController::class,'index'])->name('dashboard');

});


/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
