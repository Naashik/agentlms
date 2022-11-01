@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('dashboard_select','active')
@section('leaddrop_select','here show').
@section('title_select','Lead Details')

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

    <div class="container">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered user_datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone number</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Progress Status</th>
                            <th>Retention Status</th>
                            <th>Recent Transaction</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">

$(document).ready(function(e) {

    fetchtransaction();

        function fetchtransaction(status = '') {
            var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("lead.details") }}',
                data:{status:status}
                },
            columns: [
            {data: 'name', name: 'name'},
            {data: 'phonenumber', name: 'phonenumber'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
            {data: 'progressstatus', name: 'progressstatus'},
            {data: 'retentionstatus', name: 'retentionstatus'},
            {data: 'transaction', name: 'transaction'},
            {
                data: function(row) {
                    return  '<div style="display:flex; flex-wrap: no-wrap; align-items:center"> <a href="callto:'+ row.phonenumber +'" class="edit btn btn-secondary btn-sm">Call</a>  <a href="/leadview/' + row.leadid + '" class="edit btn btn-success mx-4 btn-sm">View</a> <a href="/updatelead/' + row.leadid + '" class="edit btn btn-secondary btn-sm">Update</a> <a href="/editlead/' + row.leadid + '" class="edit btn btn-secondary btn-sm">Edit</a></div>'
                }
            }
        ]
    });
    }

    $('#status').on('change', function() {
        var status = $('#status').val();
        if(status != '') {
            $('.user_datatable').DataTable().destroy();
            fetchtransaction(status);
        }
            
    });
           
});
</script>

@endsection