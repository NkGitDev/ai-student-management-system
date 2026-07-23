<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PageController;
use App\Http\Middleware\CheckPaymentAuth;
use App\Http\Controllers\AIChatbotController;

// AI Chatbot Route (POST Method)
Route::post('/ai-chat', [AIChatbotController::class, 'chat'])->name('ai.chat');

// Auth Routes
// routes/web.php
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


// Studends Routes
Route::get('/students', [StudentController::class, 'manageStudents'])->name('manage-students');
Route::get('/student/add', [StudentController::class, 'addStudent'])->name('add-student');
Route::post('/student/create', [StudentController::class, 'createStudent'])->name('create-student');
Route::get('/student/edit/{id}', [StudentController::class, 'editStudent'])->name('edit-student');
Route::post('/student/update/{id}', [StudentController::class, 'updateStudent'])->name('update-student');
Route::get('/student/print/{id}', [StudentController::class, 'printStudentDetails'])->name('print-student');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

// Page Routes
Route::get('/courses', [PageController::class, 'courses'])->name('courses.all');
Route::get('/opportunities', [PageController::class, 'opportunities'])->name('opportunities');
Route::get('/about', [PageController::class, 'about'])->name('about');



use App\Http\Controllers\PaymentController;

Route::get('/student/payment-login', [PaymentController::class, 'showLoginForm'])->name('payment-login-page');
Route::post('/student/payment-login', [PaymentController::class, 'processLogin'])->name('payment-login-process');

//Route::match(['get', 'post'], '/student/payment-login', [PaymentController::class, 'processLogin'])->name('payment-login-process');
Route::match(['get', 'post'], '/student/payment-process', [PaymentController::class, 'showPaymentProcess'])->name('payment-process')->middleware(CheckPaymentAuth::class);

Route::post('/student/payment-confirm', [PaymentController::class, 'showPaymentConfirm'])->name('payment-confirm');
Route::post('/student/enrolled', [StudentController::class, 'showEnrollConfirm'])->name('enroll-confirm');

Route::get('/refresh-captcha', [PaymentController::class, 'refreshCaptcha'])->name('refresh-captcha');


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/user-profile', UserController::class);



Route::post('/dummy-payment-submit', function () {
    // Yahan aap success/failure logic likh sakte hain
    return response()->json(['message' => 'Payment processed (dummy).']);
})->name('dummy.payment.submit');


Route::get('/{any}', function () {
    return response()->view('errors.page-not-found', [], 404);
})->where('any', '.*');
