@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('dashboard_select','active')
@section('leaddrop_select','here show')

<div>
    <div class="mt-10 m-5 ">

        <h2 style="font-size:20px">LEAD DETAILS</h2>


        <!--end::Title-->
        <!--begin::Subtitle-->

        <!--end::Subtitle=-->
    </div>
    <label class="d-flex bg-transparent ">
        <div class="box fw-bold ">

            <select name="status" id="status" class="form-control m-5 box fw-bold" style="width:13rem">
                <option value='All'>All</option>
                @foreach($statusvalues as $status)
                <option value='{{$status->status}}'>{{$status->status}}</option>
                @endforeach

            </select>
        </div>
    </label>

    <table class="table ms-5 mt-10">

        <thead>
            <tr>

                <th id="th" scope="col">Name</th>
                <th id="th" scope="col">Phone number</th>
                <th id="th" scope="col">Email</th>
                <th id="th" scope="col" style="width:7rem;">Status</th>
                <th id="th" scope="col" style="width:7rem;">Progress Status</th>
                <th id="th" scope="col" style="width:7rem;">Retention Status</th>
                <th id="th" scope="col">Recent Transaction</th>
                <th id="th" scope="col" style="width:25rem; text-align: center">Actions</th>

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
                result[0].leads.forEach((res) => {
                    res.transaction = 'No Transaction Data'
                    result[1].forEach((trans) => {
                        if (trans.leadid === res.leadid) {
                            res.transaction = trans.transaction
                        }
                    })
                })
                $.each(result[0].leads, function(key, value) {
                    var val;
                    if (value.status == "Assigned") {
                        val += `<td><img src="../media/logos/button-right.png"
                                                    style="width: 15px; margin-right: 2px" alt="" />${value.status}
                                            </td>`
                    } else if (value.status == "Unassigned") {
                        val += `<td><img src="../media/logos/button-wrong.png"
                                                    style="width: 15px; margin-right: 2px" alt="" />${value.status}
                                            </td>`
                    } else {
                        val += `<td>${value.status} </td>`
                    }
                    var tr = '<tr> <td>' + value
                        .name + ' </td> <td> <a href="tel: ' + value.phonenumber + '">' +
                        value.phonenumber +
                        ' </a> </td> <td> <a href="mailto:' + value.email + '"> ' + value
                        .email +
                        ' <a/> </td> ' + val +
                        ' <td>' + value.progressstatus + ' </td> <td> ' + value
                        .retentionstatus + ' </td> <td>' + value
                        .transaction +
                        ' </td> <td class="d-flex justify-content-center"> <button class="btnfile"> <i class="fa-solid fa-phone" style="color:white"></i> Call</button> <a target="_blank" style="margin-right:1rem;margin-left:1rem" href="/leadview/' +
                        value.leadid +
                        '"><button class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white;"></i> View</button></a> <a target="_blank"   href="/updatelead/' +
                        value.leadid +
                        '"><button class="btnfile"><i class="fa-sharp fa-solid fa-file-import" style="color:white"></i> Update</button></a>   </td>  </tr>';
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
                    result[0].leads.forEach((res) => {
                        res.transaction = 'No Transaction Data'
                        result[1].forEach((trans) => {
                            if (trans.leadid === res.leadid) {
                                res.transaction = trans.transaction
                            }
                        })
                    })
                    $.each(result[0].leads, function(key, value) {
                        var val;
                        if (value.status == "Assigned") {
                            val += `<td><img src="../media/logos/button-right.png"
                                                    style="width: 15px; margin-right: 2px" alt="" />${value.status}
                                            </td>`
                        } else if (value.status == "Unassigned") {
                            val += `<td><img src="../media/logos/button-wrong.png"
                                                    style="width: 15px; margin-right: 2px" alt="" />${value.status}
                                            </td>`
                        } else {
                            val += `<td>${value.status} </td>`
                        }
                        var tr = '<tr> <td>' + value
                            .name + ' </td> <td> <a href="tel: ' + value
                            .phonenumber + '">' +
                            value.phonenumber +
                            ' </a> </td> <td> <a href="mailto:' + value
                            .email +
                            '">' +
                            value.email + ' <a/> </td> ' + val +
                            ' <td>' + value.progressstatus + ' </td>  <td> ' + value
                            .retentionstatus + ' </td> <td>' +
                            value
                            .transaction +
                            ' </td> <td class="d-flex justify-content-center"> <button class="btnfile"> <i class="fa-solid fa-phone" style="color:white"></i> Call</button> <a target="_blank" style="margin-right:1rem;margin-left:1rem" href="/leadview/' +
                            value.leadid +
                            '"><button class="btnfile"><i class="fa-solid fa-file-circle-check" style="color:white;"></i> View</button></a> <a target="_blank"  href="/updatelead/' +
                            value.leadid +
                            '"><button class="btnfile"><i class="fa-sharp fa-solid fa-file-import" style="color:white"></i> Update</button></a>   </td>  </tr>';
                        $("table tbody").append(tr);
                    });
                }
            });
        });
    });
    </script>

    @endsection