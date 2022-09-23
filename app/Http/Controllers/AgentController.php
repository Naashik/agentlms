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
use App\Models\Statusvalue;
use Hash;
use Session;
use DB;
use Carbon\Carbon;

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

    public function fetchleads(Request $request)
    {

        $agentid = Session::get('loginId');  
        $leads = Lead::where('agentid','=', $agentid)->get();

        $transaction = array();

        foreach($leads as $lead) {
            $transactiondata = Transactiondetail::where('leadid','=', $lead->id)
            ->orderBy('created_at', 'desc')
            ->first();
            if($transactiondata != null){
                array_push($transaction, $transactiondata);
            }        
            
        }
        
        if($request->status == "All") {
            $data['leads'] = DB::table('leads')
            ->join('statuses', 'leads.id', '=', 'statuses.leadid')
            ->where('leads.agentid', '=', $agentid)
            ->get();
        }

        else if($request->status == "New") {
            $data['leads'] = DB::table('leads')
                ->join('statuses', 'leads.id', '=', 'statuses.leadid')
                ->orderBy('statuses.updated_at','desc')
                ->where('leads.agentid', '=', $agentid)
                ->where('statuses.status', '=', $request->status)
                ->get();
        }
        else {
            $data['leads'] = DB::table('leads')
            ->join('statuses', 'leads.id', '=', 'statuses.leadid')
            ->where('leads.agentid', '=', $agentid)
            ->where('statuses.status', '=', $request->status)
            ->get();
        }

       
        $returnArr = [$data, $transaction];    
        return response()->json($returnArr);
        

    }

    public function fetchtransaction(Request $request) {
        $from = $request->from;
        $to = $request->to;

        $agentid = Session::get('loginId'); 
        
        if($from && $to){
            $data['leads'] = DB::table('leads')
            ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
            ->where('leads.agentid', '=', $agentid)
            ->where('reminder', '!=', NULL)
            ->orderBy('reminder', 'asc')
            ->orderBy('time', 'asc')
            ->whereBetween('reminder', [$from, $to])     
            ->get();
        }
        else {
            $data['leads'] = DB::table('leads')
            ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
            ->where('leads.agentid', '=', $agentid)
            ->where('reminder', '!=', NULL)
            ->orderBy('reminder', 'asc')
            ->orderBy('time', 'asc')
            ->get(); 
        }
        return response()->json($data);

    }

    public function leadtransactionview() {
        $agentid = Session::get('loginId');
        $agent = User::where('id','=', $agentid)->first();

        $leads = DB::table('leads')
            ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
            ->where('leads.agentid', '=', $agentid)
            ->where('reminder', '!=', NULL)
            ->orderBy('reminder', 'asc')
            ->orderBy('time', 'asc')
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

        $leadtransaction = DB::table('leads')
        ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
        ->where('leads.agentid', '=', $agentid)
        ->where('leads.id', '=', $id)
        ->orderBy('reminder', 'asc')
        ->orderBy('time', 'asc')
        ->get();
      
        return view('agent.leadview', [
            'lead' => $lead,
            'agent' => $agent,
            'leaddetails' => $leaddetails,
            'countrydetails' => $countrydetails,
            'leadtransaction' => $leadtransaction,
        ]);
    }

    public function deletetransaction($id){

        $transaction = Transactiondetail::findOrFail($id);
        $res = $transaction->delete();
  
        if($res) {
            return back()->with('success','Transaction deleted successfully');
        }
        else {
            return back()->with('fail','Something went wrong. Please try again');
        }
     }

    public function updatedetails(Request $request, $id) {

        $date = Carbon::today()->toDateString();

        $result = Status::where('leadid', $id)
        ->update(['status' => $request->status]);

        if($request->transaction){
            $transactiondetail = new Transactiondetail; 
            $transactiondetail->transaction = $request->transaction;
            $transactiondetail->reminder = $request->date;
            $transactiondetail->time = $request->time;
            $transactiondetail->leadid = $id;
            
          $res = $transactiondetail->save();
        }

            

          if(isset($res) || $result) {
            return back()->with('success',"Lead details updated");
        }

        else {
            return back()->with('fail',"Something went wrong");
        }
    }

    public function updatelead($id){

        $agentid = Session::get('loginId');
        $agent = User::where('id','=', $agentid)->first();
        $lead = Lead::where('id','=', $id)->first();
        $statuses = Statusvalue::all();

        return view('agent.updatelead',[ 
            'lead' => $lead,
            'agent' => $agent,
            'statuses' => $statuses,
        ]);
    }


    public function viewleads() {

        $agentid = Session::get('loginId');
        $leads = Lead::where('agentid','=', $agentid)->get();
        $statuses = DB::table('statuses')->get();
        $agent = User::where('id','=', $agentid)->first(); 
    
        return view('agent.viewleads', [
            'leads' => $leads,
            'agent' => $agent,
            'statuses' => $statuses,
        ]);
    }

    public function home() {

        $agentid = Session::get('loginId');  
        
        $agentid = Session::get('loginId');
        $leads = Lead::where('agentid','=', $agentid)->get();
        $leadstatus = DB::table('leads')
        ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
        ->where('reminder', '!=', NULL)
        ->get();
        $agent = User::where('id','=', $agentid)->first();

        return view('agent.home', [
            'leads' => $leads,
            'agent' => $agent,
            'leadstatus' => $leadstatus,

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

    $leads = Lead::where('agentid','=', $userId)->get();

    $leadtransaction = DB::table('leads')
        ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
        ->get();

     if($user){
        if($user->verification_code == $request->number){

            $user->verification_code = null;
            $user->verified = true;
            $user->update();
                   
                if(count($leadtransaction) > 0){     
                    return redirect('leadtransactionview');       
                    
                }

                else {
                    return redirect('home');
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