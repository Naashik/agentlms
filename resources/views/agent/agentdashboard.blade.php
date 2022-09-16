@extends('layouts.layout', ['agent' => $agent])
@section('content')

<table class="table ms-5 mt-3 w-50">

    <thead>
        <tr>
            <th scope="col">Bacthid</th>
            <th scope="col">Name</th>
            <th scope="col">Phone number</th>
            <th scope="col">Email</th>
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
        </tr>
        @endforeach
    </tbody>
    @endif
</table>
@endsection