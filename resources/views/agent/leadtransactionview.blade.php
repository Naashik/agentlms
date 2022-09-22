@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('transaction_select','active')
@section('leaddrop_select','here show')
<div class="mt-10 m-5 ">

    <h2 style="font-size:20px" class="mb-5">REMINDER DETAILS</h2>


    <!--end::Title-->
    <!--begin::Subtitle-->

    <!--end::Subtitle=-->
<div class="d-flex">
    <div class="d-flex fv-row mb-8 w-25 " >
        <label class="me-6 form-control bg-transparent" style="width:5rem;font-weight:bold" for="">From</label>
        <input class="form-control bg-transparent" type="date" id="from" name="from">
    </div>

    <div class="d-flex fv-row mb-8 w-25">
        <label class="me-6 form-control bg-transparent mx-5" style="width:5rem;font-weight:bold" for="">To</label>
        <input class="form-control bg-transparent " type="date" id="to" name="to">
    </div>
</div>
  <button type="submit" id="search" class="btnfile"><i class="fa-solid fa-filter" style="color:white"></i>
        <!--begin::Indicator label-->
        <span class="indicator-label"> Filter</span>
        <!--end::Indicator label-->
        <!--begin::Indicator progress-->
        <!--end::Indicator progress-->
    </button>
</div>
<script>
$(document).ready(function(e) {


    $('#search').on('click', function() {
        var from = document.getElementById("from").value;
        var to = document.getElementById("to").value;

        $("table tbody").html('');

        $.ajax({
            url: "{{url('api/fetch-transaction')}}",
            type: "POST",
            data: {
                from: from,
                to: to,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {

                $.each(result.leads, function(key, value) {

                    

                    var tr = '<tr> <td>' + value
                        .name + ' </td> <td>' + value.transaction +
                        ' </td> <td>' + value.reminder +
                        ' </td> <td>' + value.time +
                        '</td>  <td>' + value.created_at +
                        '</td> <td style="text-align:center ;" class="w-25"> <form id="form2" method="get" action="/leadview/' +
                        value.leadid +
                        '"></form> <button type="submit" form="form2" class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white"></i> View</button> </td>  </tr>'
                       

                        

                    $("table tbody").append(tr);
                });

            }
        });
    });
});
</script>
<table class="table ms-5 mt-10 ">

    <thead>
        <tr>
            <th id="th" scope="col">Name</th>
            <th id="th" scope="col">Transaction details</th>
            <th id="th" scope="col">Reminder date</th>
            <th id="th" scope="col">Reminder time</th>
            <th id="th" scope="col">Created at</th>
            <th id="th" scope="col"></th>


        </tr>
    </thead>
    @if(count($leads) > 0)
    <tbody>
        @foreach($leads as $lead)
        <tr>
            <td>{{$lead->name}}</td>
            <td>{{$lead->transaction}}</td>
            @if ($lead->reminder)
            <td>{{$lead->reminder}}</td>
            @else
            <td>NULL</td>
            @endif
            @if ($lead->time)
            <td>{{$lead->time}}</td>
            @else
            <td>NULL</td>
            @endif
            <td>{{$lead->created_at}}</td>
            <td style="text-align:center ;">
            <a style="margin-right:3rem;margin-left:3rem"  href="/leadview/{{$lead->leadid}}' +
                        value.leadid +
                        '"><button class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white"></i> View</button></a></td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>
@endsection