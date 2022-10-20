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

Route::get('/viewleads',[AgentController::class,'viewleads'])->name('viewleads')->middleware('isLoggedIn');

Route::get('/home',[AgentController::class,'home'])->name('home')->middleware('isLoggedIn');

Route::get('/leadview/{id}',[AgentController::class,'leadview'])->name('leadview')->middleware('isLoggedIn');

Route::delete('/deletetransaction/{id}', [AgentController::class, 'deletetransaction'])->name('deletetransaction');

Route::get('/leadtransactionview',[AgentController::class,'leadtransactionview'])->name('leadtransactionview')->middleware('isLoggedIn');

Route::get('/updatelead/{id}',[AgentController::class,'updatelead'])->name('updatelead')->middleware('isLoggedIn');

Route::post('/updatedetails/{id}',[AgentController::class,'updatedetails'])->name('updatedetails');

Route::post('recaptcha',[AgentController::class,'recaptcha'])->name('recaptcha');

Route::post('login-user',[AgentController::class,'loginUser'])->name('login-user');

Route::post('email/verification',[AgentController::class,'emailUser'])->name('email/verification');

Route::post('logout',[AgentController::class,'logout'])->name('logout');

Route::get('api/fetch-transaction', [AgentController::class, 'fetchtransaction'])->name('transaction.details');

Route::get('api/fetch-leads', [AgentController::class, 'fetchdetails'])->name('lead.details');