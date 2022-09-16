<?php

use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;



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

Route::get('/agentlogin',[AgentController::class,'agentlogin'])->name('agentlogin')->middleware('alreadyLoggedIn');

Route::get('/',[AgentController::class,'index'])->name('index')->middleware('alreadyLoggedIn');

Route::get('/email',[AgentController::class,'email'])->name('email');

Route::get('/agentdashboard',[AgentController::class,'agentdashboard'])->name('agentdashboard')->middleware('isLoggedIn');



Route::post('recaptcha',[AgentController::class,'recaptcha'])->name('recaptcha');

Route::post('login-user',[AgentController::class,'loginUser'])->name('login-user');

Route::post('email/verification',[AgentController::class,'emailUser'])->name('email/verification');

Route::post('logout',[AgentController::class,'logout'])->name('logout');