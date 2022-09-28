@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('title_select','Lead Profile')

<div>
<!-- <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
    <div class="mt-10 m-5 ">

        <div class="d-grid">

            <h2 style="font-size:20px">LEAD PROFILE</h2>


        </div>


        <table class="table mt-10 w-25 caption-top ">
            <thead>
                <tr>
                    <th id="th">Batch ID</th>
                    <td>{{$lead->batchid}}</td>
                </tr>
                <tr>
                    <th id="th">Lead Name</th>
                    <td>{{$lead->name}}</td>
                </tr>
                <tr>
                    <th id="th">Email</th>
                    <td>{{$lead->email}}</td>
                </tr>
                <tr>
                    <th id="th">Account Number</th>
                    <td>@if(isset($lead->accountnumber)) {{$lead->accountnumber}} @else
                        Null @endif</td>
                </tr>
                <tr>
                    <th id="th">Retention Status</th>
                    <td>@if(isset($status->retentionstatus)) {{$status->retentionstatus}} @else
                        Null @endif</td>
                </tr>

                <tr>
                    <th id="th">Progress Status</th>
                    <td>@if(isset($status->progressstatus)) {{$status->progressstatus}} @else
                        Null @endif</td>
                </tr>
                <tr>
                    <th id="th">Status</th>
                    <td>@if(isset($status->status)) {{$status->status}} @else
                        Null @endif</td>
                </tr>
                <tr>
                    <th id="th">Phone</th>
                    <td>{{$lead->phonenumber}}</td>
                </tr>
                <tr>
                    <th id="th">Phone 2</th>
                    <td>@if(isset($leaddetails->phonenumber2)) {{$leaddetails->phonenumber2}} @else
                        Null @endif</td>
                </tr>
                <tr>
                    <th id="th">Country</th>
                    <td>@if(isset($countrydetails->countryname)) {{$countrydetails->countryname}} @else
                        Null @endif</td>
                </tr>
                <tr>
                    <th id="th">State</th>
                    <td>@if(isset($countrydetails->state)) {{$countrydetails->state}} @else
                        Null @endif</td>
                </tr>
                <tr>
                    <th id="th">City</th>
                    <td> @if(isset($countrydetails->city)) {{$countrydetails->city}} @else
                        Null @endif</td>
                </tr>
                <tr>
                    <th id="th">Position</th>
                    <td>@if(isset($leaddetails->position)) {{$leaddetails->position}} @else
                        Null @endif</td>
                </tr>
                <tr>
                    <th id="th">Lead Type</th>
                    <td>@if(isset($leaddetails->leadtype)) {{$leaddetails->leadtype}} @else
                        Null @endif</td>
                </tr>


            </thead>

        </table>

        </form>

    </div>
    <div class="d-flex">

        <table class="table mt-10 w-50 m-5 caption-top">
            <caption style="color:black;font-weight:bold">Transaction Details</caption>
            <thead>
                <tr>
                    <th id="th" scope="col">Transaction Details</th>
                    <th id="th" scope="col">Amount</th>
                    <th id="th" scope="col">Reminder date</th>
                    <th id="th" scope="col">Reminder time</th>
                    <th id="th" scope="col">Created at</th>


                </tr>


            </thead>
            @if(isset($leadtransaction))
            <tbody>
                @foreach($leadtransaction as $transaction)
                <tr>
                    @if ($transaction->transaction)
                    <td>{{$transaction->transaction}}</td>
                    @else
                    <td>NULL</td>
                    @endif
                    @if ($transaction->amount)
                    <td>{{$transaction->amount}}</td>
                    @else
                    <td>NULL</td>
                    @endif
                    @if ($transaction->reminder)
                    <td>{{$transaction->reminder}}</td>
                    @else
                    <td>NULL</td>
                    @endif
                    @if ($transaction->time)
                    <td>{{$transaction->time}}</td>
                    @else
                    <td>NULL</td>
                    @endif
                  
                    <td>{{$transaction->created_at}}</td>

                    <!--    <td style="text-align:center ;">
                        <form method="POST" action="/deletetransaction/{{$transaction->id}}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger btn-flat py-1 show_confirm"
                                data-toggle="tooltip" title='Delete'>Delete</button>
                        </form>
                    </td> -->
                </tr>
                @endforeach
            </tbody>
            @endif
        </table>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </script>
        <script type="text/javascript">
        $('.show_confirm').click(function(event) {

            event.preventDefault();
            var form = $(this).closest("form");
            var name = $(this).data("name");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })


        });
        </script>
        <!-- <table class="table mt-10 w-50 m-5 caption-top">
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



        </table> -->
    </div>
</div>


@endsection