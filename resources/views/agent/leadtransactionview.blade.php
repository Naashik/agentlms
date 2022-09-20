@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('transaction_select','active')
<div class="mt-10 m-5 ">

    <h2 style="font-size:20px">Transaction Details</h2>


    <!--end::Title-->
    <!--begin::Subtitle-->

    <!--end::Subtitle=-->
</div>
<table class="table ms-5 mt-10 ">

    <thead>
        <tr>
            <th id="th" scope="col">Name</th>
            <th id="th" scope="col">Transaction details</th>
            <th id="th" scope="col">Reminder date</th>
            <th id="th" scope="col">Reminder time</th>
            <th id="th" scope="col">Created at</th>
        

        </tr>
    </thead>
    @if(count($leads) > 0)
    <tbody>
        @foreach($leads as $lead)
        <tr>
            <td>{{$lead->name}}</td>
            <td>{{$lead->transaction}}</td>
            <td>{{$lead->reminder}}</td>
            <td>{{$lead->time}}</td>
            <td>{{$lead->created_at}}</td>
           
        </tr>
        @endforeach
    </tbody>
    @endif
</table>
@endsection