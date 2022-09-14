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

Route::get('/', function () {
    return view('index');
});
 Route::get('/agentlogin', function (){
     return view("agentlogin");
     });
Route::get('/email',[AgentController::class,'email'])->name('email');

Route::post('recaptcha',[AgentController::class,'recaptcha'])->name('recaptcha');
Route::post('login-user',[AgentController::class,'loginUser'])->name('login-user');
Route::post('email/verification',[CustomAuthController::class,'emailUser'])->name('email/verification');