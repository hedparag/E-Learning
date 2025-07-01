<?php

use App\Http\Controllers\Admin\DemoController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\studentDashboardController;
use App\Http\Controllers\Frontend\teacherDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



/**
 * -----------FRONTEND ROUTES--------------------
 **/
Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('about', [FrontendController::class, 'about'])->name('about');

Route::get('announcements', [FrontendController::class, 'announcements'])->name('announcements');

Route::get('teachers', [FrontendController::class, 'teachers'])->name('teachers');

Route::get('contact', [FrontendController::class, 'contact'])->name('contact');

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');



/**
 * -----------STUDENT ROUTES--------------------
 **/
Route::group(['middleware' => ['auth:web', 'verified', 'checkRole:student'], 'prefix' => 'student', 'as' => 'student.'], function () {

    Route::get('/dashboard', [studentDashboardController::class, 'index'])->name('dashboard');

    Route::get('becomeInstructor/{id}', [studentDashboardController::class, 'becomeInstructor'])->name('become-instructor');
    Route::post('becomeInstructorStore/{id}', [studentDashboardController::class, 'store'])->name('become-instructor-store');

    Route::get('profile', [studentDashboardController::class, 'profile'])->name('profile.index');
    Route::get('profile/edit', [studentDashboardController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update', [studentDashboardController::class, 'updateProfile'])->name('profile.update');
    // Route::post('profile/update-password', [studentDashboardController::class, 'updatePassword'])->name('profile.update-password');
    // Route::post('profile/update-social', [studentDashboardController::class, 'updateSocial'])->name('profile.update-social');

    Route::get('enrolled-courses', [studentDashboardController::class, 'courses'])->name('enrolled-courses.index');

    Route::get('remarks', [studentDashboardController::class, 'remarks'])->name('remarks.index');

    Route::get('announcements', [studentDashboardController::class, 'announcements'])->name('announcements.index');
    // Route::get('announcements/edit', [studentDashboardController::class, 'createAnnouncements'])->name('announcements.create');
    // Route::post('announcements/update', [studentDashboardController::class, 'postAnnouncements'])->name('announcements.post');
});




/**
 * -----------TEACHERS ROUTES--------------------
 **/
Route::group(['middleware' => ['auth:web', 'verified', 'checkRole:teacher'], 'prefix' => 'teacher', 'as' => 'teacher.'], function () {

    Route::get('/dashboard', [teacherDashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [TeacherDashboardController::class, 'profile'])->name('profile.index');
    Route::get('profile/edit', [TeacherDashboardController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile/update', [TeacherDashboardController::class, 'updateProfile'])->name('profile.update');
    // Route::post('profile/update-password', [TeacherDashboardController::class, 'updatePassword'])->name('profile.update-password');
    // Route::post('profile/update-social', [TeacherDashboardController::class, 'updateSocial'])->name('profile.update-social');

    Route::get('courses', [TeacherDashboardController::class, 'courses'])->name('courses.index');
    Route::get('courses/create', [TeacherDashboardController::class, 'createCourses'])->name('courses.create');
    Route::post('courses/post', [TeacherDashboardController::class, 'postCourses'])->name('courses.post');

    Route::get('remarks', [TeacherDashboardController::class, 'remarks'])->name('remarks.index');

    Route::get('announcements', [TeacherDashboardController::class, 'announcements'])->name('announcements.index');
    Route::get('announcements/create', [TeacherDashboardController::class, 'createAnnouncements'])->name('announcements.create');
    Route::post('announcements/post', [TeacherDashboardController::class, 'postAnnouncements'])->name('announcements.post');
    Route::get('/get-common-subjects', [TeacherDashboardController::class, 'getCommonSubjects'])->name('get.common.subjects');

});



/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
