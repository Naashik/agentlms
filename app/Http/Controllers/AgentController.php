<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Lead;
use App\Models\User;
use App\Mail\OtpMail;
use App\Models\State;
use App\Models\Status;
use App\Models\Country;
use App\Models\Leaddetail;
use App\Models\Statusvalue;
use Illuminate\Http\Request;
use App\Models\Countrydetail;
use App\Models\Transactiondetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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

    public function fetchdetails(Request $request)
    {



        // $transaction = array();

        // foreach($leads as $lead) {
        //     $transactiondata = Transactiondetail::where('leadid','=', $lead->id)
        //     ->where('transaction', '!=', null)
        //     ->orderBy('created_at', 'desc')
        //     ->first();
        //     if($transactiondata != null){
        //         array_push($transaction, $transactiondata);
        //     }        
            
        // }
        
        // if($request->status == "All") {
        //     $data['leads'] = DB::table('leads')
        //     ->join('statuses', 'leads.id', '=', 'statuses.leadid')
        //     ->where('leads.agentid', '=', $agentid)
        //     ->get();
        // }

        // else {
        //     $data['leads'] = DB::table('leads')
        //     ->join('statuses', 'leads.id', '=', 'statuses.leadid')
        //     ->where('leads.agentid', '=', $agentid)
        //     ->where('statuses.progressstatus', '=', $request->status)
        //     ->get();
        // }

       
        // $returnArr = [$data, $transaction];    
        // return response()->json($returnArr);

        $agentid = Session::get('loginId');  
        $leads = Lead::where('agentid','=', $agentid)->get();
        $transaction = array();

        if(request()->ajax())
        {
           if(!empty($request->status)) {
                if($request->status == "All") {
                    $data = DB::table('leads')
                    ->join('statuses', 'leads.id', '=', 'statuses.leadid')
                    ->where('leads.agentid', '=', $agentid)
                    ->get();
                }
            
                else {
                    $data = DB::table('leads')
                    ->join('statuses', 'leads.id', '=', 'statuses.leadid')
                    ->where('leads.agentid', '=', $agentid)
                    ->where('statuses.progressstatus', '=', $request->status)
                    ->get();
                }
            }
            else {
                $data = DB::table('leads')
                ->join('statuses', 'leads.id', '=', 'statuses.leadid')
                ->where('leads.agentid', '=', $agentid)
                ->get();
    
        }

            
            foreach($data as $lead) {
                $lead->transaction = "No Transaction Data";
                $transactiondata = Transactiondetail::where('leadid','=', $lead->id)
                ->where('transaction', '!=', null)
                ->orderBy('created_at', 'desc')
                ->first();
                if($transactiondata != null){
                    array_push($transaction, $transactiondata);
                }        
                
            }

            foreach($data as $lead) {
                foreach($transaction as $tdata) {
                    if ($tdata->leadid == $lead->leadid) {
                       $lead->transaction = $tdata->transaction;
                    }
                    else {
                        $lead->transaction = NULL;
                    }
                }
            }
            
            return datatables()->of($data)->make(true);
        }
        

    }

    public function fetchtransaction(Request $request) {
    
       
        
        // if($from && $to){
        //     $data['leads'] = DB::table('leads')
        //     ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
        //     ->where('leads.agentid', '=', $agentid)
        //     ->where('reminder', '!=', NULL)
        //     ->orderBy('reminder', 'asc')
        //     ->orderBy('time', 'asc')
        //     ->whereBetween('reminder', [$from, $to])     
        //     ->get();
        // }
        // else {
        //     $data['leads'] = DB::table('leads')
        //     ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
        //     ->where('leads.agentid', '=', $agentid)
        //     ->where('reminder', '!=', NULL)
        //     ->orderBy('reminder', 'asc')
        //     ->orderBy('time', 'asc')
        //     ->get(); 
        // }
        // return response()->json($data);

        $agentid = Session::get('loginId'); 

        if(request()->ajax())
        {
           if(!empty($request->from)) {
            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            
            $data = DB::table('leads')
            ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
            ->where('leads.agentid', '=', $agentid)
            ->where('reminder', '!=', NULL)
            ->orderBy('reminder', 'asc')
            ->orderBy('time', 'asc')
            ->whereBetween('reminder', [$from, $to])     
            ->get();
            }
            
            else {
                
            $data = DB::table('leads')
            ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
            ->where('leads.agentid', '=', $agentid)
            ->where('reminder', '!=', NULL)
            ->orderBy('reminder', 'asc')
            ->orderBy('time', 'asc')
            ->get(); 
    
        }
            foreach($data as $transaction) {
                $transaction->reminder = date('d-m-Y', strtotime($transaction->reminder)); 
            }
            
            return datatables()->of($data)->make(true);
        }

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
        $status = Status::where('leadid','=', $id)->first();
        $countrydetails = Countrydetail::where('leadid','=', $id)->first();
        $agent = User::where('id','=', $agentid)->first();

        $leadtransaction = DB::table('leads')
        ->join('transactiondetails', 'leads.id', '=', 'transactiondetails.leadid')
        ->where('leads.agentid', '=', $agentid)
        ->where('leads.id', '=', $id)
        ->orderBy('transactiondetails.created_at', 'desc')
        ->get();
      
        return view('agent.leadview', [
            'lead' => $lead,
            'agent' => $agent,
            'leaddetails' => $leaddetails,
            'countrydetails' => $countrydetails,
            'leadtransaction' => $leadtransaction,
            'status' => $status,
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

     public function editlead($id){

        $agentid = Session::get('loginId');
        $agent = User::where('id','=', $agentid)->first();

        $country = null;
        $state = null;
        $city = null;
        $countries = Country::get(["name", "id", "phonecode"]);

        $userId = Session::get('loginId');
        $admin = User::where('id','=', $userId)->first();
        $countrydetail = Countrydetail::where('leadid','=', $id)->first();
        $lead = Lead::where('id','=', $id)->first();
        $leaddata = Leaddetail::where('leadid','=', $id)->first();
        if($countrydetail) {
            $country = Country::where('name','=', $countrydetail->countryname)->first();
            $state = State::where('name','=', $countrydetail->state)->first();
            $city = City::where('name','=', $countrydetail->city)->first();
        }   
 
            return view('agent.editlead', ['lead' => $lead,'agent' => $agent, 'countries' => $countries, 'countrydetail' => $countrydetail, 'leaddata' => $leaddata, 'country' => $country, 'state' => $state, 'city' => $city]);
        
     }

     public function updateleaddata(Request $request,$id) {
        //update basic details of the lead

        $res = DB::table('leads')
        ->where('id', $id)
        ->update(['name' => $request->name, 'phonenumber' => $request->phonenumber, 'email' => $request->email, 'accountnumber' => $request->accountnumber]);

        // update country details of the lead
        
        $country = Country::where('id','=', $request->countryid)->first();
        $state = State::where('id','=', $request->stateid)->first();
        $city = City::where('id','=', $request->cityid)->first();

        if($country && $state) {
            $val = Countrydetail::where('leadid', $id)->first();

             if($val) {
            
             $result = DB::table('countrydetails')
            ->where('leadid', $id)
            ->update(['countryname' => $country->name , 'state' => $state->name, 'city' => optional($city)->name, 'countrycode' => $country->phonecode]);
        }
 
        else {
            $result = DB::table('countrydetails')->insert(['countryname' => $country->name , 'state' => $state->name, 'city' => optional($city)->name, 'countrycode' => $country->phonecode, 'leadid' => $id]);
        }
        }

        //update lead position, leadtype and phonenumber2

        $position = $request->position;
        $phonenumber2 = $request->phonenumber2;
        $leadtype = $request->leadtype;

       if($position || $phonenumber2 ||  $leadtype ) {
        $lead = Leaddetail::where('leadid', $id)->first();

        if($lead) {
            
            $success = DB::table('leaddetails')
           ->where('leadid', $id)
           ->update(['position' => $request->position , 'phonenumber2' => $request->phonenumber2, 'leadtype' => $request->leadtype]);
       }

       else {
           $success = DB::table('leaddetails')->insert(['position' => $request->position , 'phonenumber2' => $request->phonenumber2, 'leadtype' => $request->leadtype,'leadid' => $id]);
       }
       }
            
        if($res || isset($result) || isset($success) ) {
            return redirect('viewleads')->with('success','Lead updated successfully');
        }
        else {
            return redirect('viewleads')->with('fail','Something went wrong. Please try again');
        }
     }

     public function deletelead($id){

        $lead = Lead::findOrFail($id);
        $res = $lead->delete();
  
        if($res) {
            return redirect('/admindashboard/viewleads')->with('success','Lead deleted successfully');
        }
        else {
            return redirect('/admindashboard/viewleads')->with('fail','Something went wrong. Please try again');
        }
     }
     public function fetchState(Request $request)
     {
         $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
         return response()->json($data);
     }
     public function fetchCity(Request $request)
     {
         $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
         return response()->json($data);
     }

    public function updatedetails(Request $request, $id) {

        $transactiondetail = new Transactiondetail;


        $result = Status::where('leadid', $id)
        ->update(['progressstatus' => $request->status, 'retentionstatus' => $request->retentionstatus]);

        if($request->transaction){          
            $transactiondetail->transaction = $request->transaction;
            $transactiondetail->reminder = $request->date;
            $transactiondetail->time = $request->time;
            $transactiondetail->leadid = $id;
         
        }
        if($request->amount) {
            $transactiondetail->amount = $request->amount;
            $transactiondetail->currency = $request->currency;
            $transactiondetail->leadid = $id;
        }

        $res = $transactiondetail->save();
            

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
        $statusvalues = DB::table('statusvalues')->get();
        $statuses = DB::table('statuses')->get();
        $agent = User::where('id','=', $agentid)->first(); 

        // $transaction = array();

        // $data = DB::table('leads')
        // ->join('statuses', 'leads.id', '=', 'statuses.leadid')
        // ->where('leads.agentid', '=', $agentid)
        // ->get();


        // foreach($data as $lead) {
        //     $lead->transaction = NULL;
        //     $transactiondata = Transactiondetail::where('leadid','=', $lead->id)
        //     ->where('transaction', '!=', null)
        //     ->orderBy('created_at', 'desc')
        //     ->first();
        //     if($transactiondata != null){
        //         array_push($transaction, $transactiondata);
        //     }        
            
        // }

        // foreach($data as $lead) {
        //     foreach($transaction as $tdata) {
        //         if ($tdata->leadid == $lead->leadid) {
        //            $lead->transaction = $tdata->transaction;
        //         }
        //     }
        // }

        // print($data);
    
        return view('agent.viewleads', [
            'statusvalues' => $statusvalues,
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
        ->where('agentid', '=', $agentid)
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
        ->where('agentid', '=', $userId)
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