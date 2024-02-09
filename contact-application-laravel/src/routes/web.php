<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomLogoutController;
use App\Http\Controllers\InquiryController;

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

Route::get('/', [InquiryController::class, 'inquiry']);
Route::get('/inquiry', [InquiryController::class, 'inquiry'])->name('inquiry');
Route::post('/confirm', [InquiryController::class, 'confirm']);
Route::post('/contacts', [InquiryController::class, 'store']);
Route::post('/store', [InquiryController::class, 'store'])->name('store');
Route::view('/thanks', 'thanks')->name('thanks');

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [CustomLogoutController::class, 'logout'])->name('logout');
