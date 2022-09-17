@extends('layouts.layout', ['agent' => $agent])
@section('content')

<div>
    <div class="mt-10 m-5 ">
        <div class="d-grid">

            <h2 style="font-size:20px">Lead Profile</h2>


        </div>
        <div><img src="../media/logos/icons8-male-user-100.png"></div>

        <form class="mt-10" style="font-size:15px">
            <label>Lead ID: {{$lead->id}}</label><br>
            <label class="mt-1">Batch ID: {{$lead->batchid}}</label><br>
            <label class="mt-1">Lead Name: {{$lead->name}}</label><br>
            <label class="mt-1">Email: {{$lead->email}}</label><br>
            <label class="mt-1">Phone: {{$lead->phonenumber}}</label><br>
            <label class="mt-1">Phone 2: @if(isset($leaddetails->phonenumber2)) {{$leaddetails->phonenumber2}} @else
                Null @endif</label><br>
            <label class="mt-1">Country: @if(isset($countrydetails->countryname)) {{$countrydetails->countryname}} @else
                Null @endif</label><br>
            <label class="mt-1">State: @if(isset($countrydetails->state)) {{$countrydetails->state}} @else
                Null @endif</label><br>
            <label class="mt-1">City: @if(isset($countrydetails->city)) {{$countrydetails->city}} @else
                Null @endif</label><br>
            <label class="mt-1">Position: @if(isset($leaddetails->position)) {{$leaddetails->position}} @else
                Null @endif</label><br>
            <label class="mt-1">Lead Type: @if(isset($leaddetails->leadtype)) {{$leaddetails->leadtype}} @else
                Null @endif</label><br>


        </form>
    </div>
    <div class="d-flex">

        <table class="table mt-10 w-50 m-5 caption-top">
            <caption style="color:black;font-weight:bold">Lead Status Transaction</caption>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Lead ID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Time stamp</th>
                    <th scope="col">Note</th>
                    <th scope="col">Reminder date</th>
                    <th scope="col">Reminder time</th>


                </tr>
            </thead>



        </table>
        <table class="table mt-10 w-50 m-5 caption-top">
            <caption style="color:black;font-weight:bold">Lead Zoiper Transaction</caption>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Lead ID</th>
                    <th scope="col">Call number</th>
                    <th scope="col">Start time</th>
                    <th scope="col">End time</th>


                </tr>
            </thead>



        </table>
    </div>
</div>


@endsection