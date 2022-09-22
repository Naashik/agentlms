@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('dashboard_select','active')

<div>
    <div class="mt-10 m-5 ">

        <h2 style="font-size:20px">Lead Details</h2>


        <!--end::Title-->
        <!--begin::Subtitle-->

        <!--end::Subtitle=-->
    </div>
    <label class="d-flex bg-transparent ">
        <div class="box fw-bold ">

            <select name="status" id="status" class="form-control m-5 box fw-bold" style="width:13rem">
                <option value='All'>All</option>
                <option value='Assigned'>New</option>
                <option value='Work in progress'>Work in progress</option>
                <option value='Closed'>Closed</option>

            </select>
        </div>
    </label>

    <table class="table ms-5 mt-10 ">

        <thead>
            <tr>

                <th id="th" scope="col">Name</th>
                <th id="th" scope="col">Phone number</th>
                <th id="th" scope="col">Email</th>
                <th id="th" scope="col">Status</th>
                <th id="th" scope="col"></th>
                <th id="th" scope="col"></th>

            </tr>
        </thead>

        <tbody>

        </tbody>

    </table>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {

        var status = document.getElementById("status").value;

        $("table tbody").html('');

        $.ajax({
            url: "{{url('api/fetch-leads')}}",
            type: "POST",
            data: {
                status: status,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {

                $.each(result.leads, function(key, value) {

                    var tr = '<tr> <td>' + value
                        .name + ' </td> <td>' + value.phonenumber +
                        ' </td> <td> <a href="mailto:' + value.email + '"> ' + value.email +
                        ' <a/> </td> <td>' + value
                        .status +
                        ' </td> <td style="text-align:center;"> <form  method="get" action="/updatelead/' +
                        value.leadid +
                        '"><button type="submit"  class="btn btn-xs btn-secondary btn-flat">Update</button></form>  </td> <td style="text-align:center ;"> <form method="get" action="/leadview/' +
                        value.leadid +
                        '"><button type="submit" class="btn btn-xs btn-primary btn-flat" title="View">View</button></form>  </td>  </tr>';

                    $("table tbody").append(tr);


                });

            }
        });


    })
    </script>

    <script>
    $(document).ready(function() {
        $('#status').on('change', function() {
            var status = this.value;

            $("table tbody").html('');

            $.ajax({
                url: "{{url('api/fetch-leads')}}",
                type: "POST",
                data: {
                    status: status,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {

                    $.each(result.leads, function(key, value) {


                        var tr = '<tr> <td>' + value
                            .name + ' </td> <td>' + value.phonenumber +
                            ' </td> <td> <a href="mailto:' + value.email + '">' +
                            value.email + ' <a/> </td> <td>' + value
                            .status +
                            ' </td> <td style="text-align:center ;"> <form method="get" action="/updatelead/' +
                            value.leadid +
                            '"><button type="submit" class="btn btn-xs btn-secondary btn-flat">Update</button></form>  </td> <td style="text-align:center ;"> <form method="get" action="/leadview/' +
                            value.leadid +
                            '"><button type="submit" class="btn btn-xs btn-primary btn-flat" title="View">View</button></form>  </td>  </tr>'
                        $("table tbody").append(tr);

                    });

                }
            });
        });
    });
    </script>

    @endsection