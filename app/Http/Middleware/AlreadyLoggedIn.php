<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App\Models\User;

class AlreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $userId = Session::get('loginId');;
        $user = User::where('id','=', $userId)->first();

        if($user){
            if($user->verified==true ){
                return back();
            }
            else {
                Session::forget('loginId');
            }
        }
        
        

        return $next($request);
    }
}