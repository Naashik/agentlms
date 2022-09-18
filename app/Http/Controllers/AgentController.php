<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use App\Models\Status;
use App\Models\Lead;
use App\Models\Leaddetail;
use App\Models\Countrydetail;
use App\Models\Transactiondetail;
use Hash;
use Session;
use DB;

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

    public function leadtransactionview() {
        $agentid = Session::get('loginId');
        $agent = User::where('id','=', $agentid)->first();

        $leads = DB::table('leads')
            ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
            ->get();

            
        return view('agent.leadtransactionview', [
            'agent' => $agent,
            'leads' => $leads,
        ]);
    }

    public function leadview($id) {

        $agentid = Session::get('loginId');
        $lead = Lead::where('id','=', $id)->first();
        $leaddetails = Leaddetail::where('leadid','=', $id)->first();
        $countrydetails = Countrydetail::where('leadid','=', $id)->first();
        $agent = User::where('id','=', $agentid)->first();
      


        return view('agent.leadview', [
            'lead' => $lead,
            'agent' => $agent,
            'leaddetails' => $leaddetails,
            'countrydetails' => $countrydetails,
        ]);
    }

    public function updatedetails(Request $request, $id) {

        $val = Transactiondetail::where('leadid', $id)->first();

        if($val){
            Transactiondetail::where('leadid', $id)
                ->update(['transaction' => $request->transaction, 'reminder' => $request->dob ]);
        }
        else {
            $transactiondetail = new Transactiondetail; 
            $transactiondetail->transaction = $request->transaction;
            $transactiondetail->reminder = $request->dob;
            $transactiondetail->leadid = $id;
            
            $transactiondetail->save();
        }
    }

    public function updatelead($id){

        $agentid = Session::get('loginId');
        $agent = User::where('id','=', $agentid)->first();
        $lead = Lead::where('id','=', $id)->first();

        return view('agent.updatelead',[ 
            'lead' => $lead,
            'agent' => $agent
        ]);
    }

    public function updatestatus($id){
        $res = Status::where('leadid', $id)
        ->update(['status' => 'Work in Progress']);

        if($res) {
            return back()->with('success',"Lead Status Changed");
        }

        else {
            return back()->with('fail',"Something went wrong");
        }
    }

    public function agentdashboard() {

        $agentid = Session::get('loginId');
        $leads = Lead::where('agentid','=', $agentid)->get();
        $statuses = DB::table('statuses')->get();
        $agent = User::where('id','=', $agentid)->first();


        return view('agent.agentdashboard', [
            'leads' => $leads,
            'agent' => $agent,
            'statuses' => $statuses,
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