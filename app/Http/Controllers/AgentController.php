<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use App\Models\Lead;
use Hash;
use Session;

class AgentController extends Controller
{

    public function email () {
        return view('email');
    }

    public function index() {
        return view('index');
    }

    public function agentlogin() {
        return view('agentlogin');
    }

    public function leadview() {

        $agentid = Session::get('loginId');
        $leads = Lead::where('agentid','=', $agentid)->get();
        $agent = User::where('id','=', $agentid)->first();


        return view('agent.leadview', [
            'leads' => $leads,
            'agent' => $agent,
        ]);
    }

    public function agentdashboard() {

        $agentid = Session::get('loginId');
        $leads = Lead::where('agentid','=', $agentid)->get();
        $agent = User::where('id','=', $agentid)->first();


        return view('agent.agentdashboard', [
            'leads' => $leads,
            'agent' => $agent,
        ]);
    }

    
    public function loginUser(Request $request){

       
        $request->validate([
            'name'=>'required',
            'password'=>'required'
        ]);
        
        $user = User::where('name','=',$request->name)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId',$user->id);

                $pin = mt_rand(1000000, 9999999);
                $user->verification_code = $pin;
                $user->save();

              Mail::to($user->email)->send(new OtpMail($pin));

               return redirect('email');

            }

                else{
                    return back()->with('fail','Password not matches.');
                }
            }
        
        else{
            return back()->with('fail','This username is not valid');
        }
    }
 


    public function recaptcha(Request $request)
    {
        $token = $request->input('g-recaptcha-response');
    
        if(strlen($token) > 0 ){
            return redirect('agentlogin');
        }
        else{
            
        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);
                
        }
       
}
public function emailUser(Request $request)
{

    $userId = $request->session()->get('loginId');

    $user = User::where('id','=', $userId)->first();

    if($user){
        if($user->verification_code == $request->number){

            $user->verification_code = null;
            $user->verified = true;
            $user->update();
            if($user->admin == 1) {
                // return redirect('agentdashboard');
            }
            else {
                return redirect('agentdashboard');
            }
            
        }
        
        else {
            return back()->with('fail','The pin is incorrect');
        }  
    }
    else {
        return redirect('agentlogin')->with('fail','You have been logged out. Please try again');
    }
       
       
}

public function logout(){

    $userId = Session::get('loginId');;

    $user = User::where('id','=', $userId)->first();

    if(Session::has('loginId')){
        $user->verified = false;
        $user->update();
        Session::pull('loginId');
        Session::forget('loginId');

        return redirect('agentlogin');
    }
}
}