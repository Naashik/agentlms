@extends('layouts.layout', ['agent' => $agent])
@section('content')

<div class="mt-10 m-5 ">

    <h2 style="font-size:20px">Lead Transaction Details</h2>


    <!--end::Title-->
    <!--begin::Subtitle-->

    <!--end::Subtitle=-->
</div>
<table class="table ms-5 mt-10 ">

    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Transaction details</th>
            <th scope="col">Reminder date</th>
            <th scope="col">Reminder time</th>

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
        </tr>
        @endforeach
    </tbody>
    @endif
</table>
@endsection