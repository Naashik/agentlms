@extends('layouts.layout', ['agent' => $agent])
@section('content')

<div>
    <div class="mt-10 m-5 ">
        <div class="d-grid">

            <h2 style="font-size:20px">Lead Profile</h2>


        </div>
        <div><img src="../media/logos/icons8-male-user-100.png"></div>

        <table class="table mt-10 w-25 caption-top " >
             <thead>
                <tr >
                    <td style="font-weight:bold">Batch ID</td>
                    <td>{{$lead->batchid}}</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">Lead Name</td>
                    <td>{{$lead->name}}</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">Email</td>
                    <td>{{$lead->email}}</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">Phone</td>
                    <td>{{$lead->phonenumber}}</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">Phone 2</td>
                    <td>@if(isset($leaddetails->phonenumber2)) {{$leaddetails->phonenumber2}} @else
                Null @endif</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">Country</td>
                    <td>@if(isset($countrydetails->countryname)) {{$countrydetails->countryname}} @else
                Null @endif</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">State</td>
                    <td>@if(isset($countrydetails->state)) {{$countrydetails->state}} @else
                Null @endif</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">City</td>
                    <td> @if(isset($countrydetails->city)) {{$countrydetails->city}} @else
                Null @endif</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">Position</td>
                    <td>@if(isset($leaddetails->position)) {{$leaddetails->position}} @else
                Null @endif</td>
                </tr>
                <tr>
                    <td style="font-weight:bold">Lead Type</td>
                    <td>@if(isset($leaddetails->leadtype)) {{$leaddetails->leadtype}} @else
                Null @endif</td>
                </tr>


            </thead>
    
        </table>

        </form>
       
    </div>
    <div class="d-flex">

        <table class="table mt-10 w-50 m-5 caption-top">
            <caption style="color:black;font-weight:bold">Lead Status Transaction</caption>
            <thead>
                <tr>

               
                    <th scope="col">Name</th>
                    <th scope="col">Transaction Details</th>
                    <th scope="col">Reminder date</th>
                    <th scope="col">Reminder time</th>


                </tr>


            </thead>
            @if(isset($leadtransaction))
            <tbody>
                @foreach($leadtransaction as $transaction)
                <tr>
        
                    <td>{{$transaction->name}}</td>
                    <td>{{$transaction->transaction}}</td>
                    <td>{{$transaction->reminder}}</td>
                    <td>{{$transaction->time}}</td>

                    <td>
                        <form method="POST" action="/deletetransaction/{{$transaction->id}}">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger btn-flat py-1 show_confirm"
                                data-toggle="tooltip" title='Delete'>Delete</button>
                        </form>
                    </td>
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