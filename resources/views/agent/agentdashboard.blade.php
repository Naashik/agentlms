@extends('layouts.layout', ['agent' => $agent])
@section('content')
<div>
    <div class="mt-10 m-5 ">

        <h2 style="font-size:20px">Lead Details</h2>


        <!--end::Title-->
        <!--begin::Subtitle-->

        <!--end::Subtitle=-->
    </div>
    <table class="table ms-5 mt-10 ">

        <thead>
            <tr>
                <th scope="col">Bacthid</th>
                <th scope="col">Name</th>
                <th scope="col">Phone number</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
                <th scope="col"></th>

            </tr>
        </thead>
        @if(count($leads) > 0)
        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td>{{$lead->batchid}}</td>
                <td>{{$lead->name}}</td>
                <td>{{$lead->phonenumber}}</td>
                <td>{{$lead->email}}</td>
                @foreach($statuses as $status)
                @if($status->leadid == $lead->id)
                <td>{{$status->status}}</td>
                @endif
                @endforeach
                <td>
                    <form method="GET" action="/updatelead/{{$lead->id}}">
                        @csrf

                        <button type="submit" class="btn btn-xs btn-secondary btn-flat">Update</button>
                    </form>
                </td>
                <td>
                    <form method="GET" action="/leadview/{{$lead->id}}">
                        @csrf

                        <button type="submit" class="btn-xs btn btn-primary btn-flat show_confirm" data-toggle="tooltip"
                            title='View'>View</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
    @endsection