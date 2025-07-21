<?php

use App\Http\Controllers\Admin\addClassController;
use App\Http\Controllers\Admin\AddSubjectController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\CourseApproveController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\FinalizedController;
use App\Http\Controllers\Admin\InstructorRequestController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\MockSettingController;
use App\Http\Controllers\Admin\ReportCardController;
use App\Http\Controllers\Admin\SubjectAssignController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    /* Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);*/

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('instructorRequest', [InstructorRequestController::class, 'index'])->name('instructor-request');
    Route::get('download/{user}', [InstructorRequestController::class, 'download'])->name('document-download');
    Route::post('requestUpdate/{user}', [InstructorRequestController::class, 'update'])->name('request-update');
    //Route::post('addClass',[addClassController::class,'store'])
    Route::resource('class', addClassController::class);
    Route::resource('subject', AddSubjectController::class);
    Route::get('subCategory/{id}', [AddSubjectController::class, 'categoryView'])->name('category');
    Route::post('subCategory/{id}', [AddSubjectController::class, 'category'])->name('category-store');
    Route::resource('subjectAssign', SubjectAssignController::class);
    Route::resource('announcement', AnnouncementController::class);
    Route::get('announcementEdit',[AnnouncementController::class,'approveEdit'])->name('announcement.approveEdit');
    Route::post('announcementApprove/{id}',[AnnouncementController::class,'approve'])->name('announcementApprove');
    Route::get('data', [DataController::class, 'index']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
    Route::get('mock',[MockSettingController::class,'index'])->name('mock');
    Route::post('mock/store',[MockSettingController::class,'store'])->name('mock.store');
     Route::get('courseApprove',[CourseApproveController::class,'index'])->name('courseApprove');
     Route::post('approveSubmit/{id}',[CourseApproveController::class,'store'])->name('approveSubmit');
     Route::get('coursePreview/{id}',[CourseApproveController::class,'preview'])->name('course.preview');
     Route::get('ReportCard',[ReportCardController::class,'index'])->name('reportCard');
     Route::get('marks',[FinalizedController::class,'index'])->name('marks');
      Route::get('resultDetails/{id}',[FinalizedController::class,'getDetailedResult'])->name('resultDetails');
      Route::post('finalized',[FinalizedController::class,'report'])->name('finalize');
      Route::get('generateReport',[FinalizedController::class,'generateReport'])->name('generateReportCard');
      Route::get('ReportCardView',[FinalizedController::class,'reportView'])->name('reportView');
       Route::get('message',[MessageController::class,'index'])->name('message');
       Route::post('course-Message-Review-Store/{id}',[MessageController::class,'store'])->name('courseMessageReview');
       Route::get('fetchAllCourse',[CourseApproveController::class,'fetch'])->name('fetch-all-courses');

});
