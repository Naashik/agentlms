@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('transaction_select','active')
@section('leaddrop_select','here show')
@section('title_select','Reminders')


<div class="mt-10 m-5 ">

    <h2 style="font-size:20px" class="mb-5">REMINDER DETAILS</h2>


    <!--end::Title-->
    <!--begin::Subtitle-->

    <!--end::Subtitle=-->
    <div class="d-flex">
        <div class="d-flex fv-row mb-8 w-25 ">
            <label class="me-6 form-control bg-transparent" style="width:5rem;font-weight:bold" for="">From</label>
            <input class="form-control bg-transparent" placeholder="DD/MM/YYYY" type="date" id="from" name="from">
        </div>

        <div class="d-flex fv-row mb-8 w-25">
            <label class="me-6 form-control bg-transparent mx-5" style="width:5rem;font-weight:bold" for="">To</label>
            <input class="form-control bg-transparent" placeholder="DD/MM/YYYY" type="date" id="to" name="to">
        </div>
    </div>
    <button type="submit" id="search" class="btnfile"><i class="fa-solid fa-filter" style="color:white"></i>
        <!--begin::Indicator label-->
        <span class="indicator-label">Filter</span>
        <!--end::Indicator label-->
    </button>
</div>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>

    const config = {
    dateFormat: "d-m-Y",
    disableMobile: "true"
}
    flatpickr("input[type=date]", config);
</script>

<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Transaction Details</th>
                        <th>Reminder Date</th>
                        <th>Reminder Time</th>
                        <th>Created At</th>
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

        function fetchtransaction(from = '', to = '') {
            var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("transaction.details") }}',
                data:{from:from, to:to}
                },
            columns: [
            {data: 'name', name: 'name'},
            {data: 'transaction', name: 'transaction'},
            {data: 'reminder', name: 'reminder'},
            {data: 'time', name: 'time'},
            {data: 'created_at', name: 'created_at'},
            {
                data: function(row) {
                    return  '<div style="display:flex; flex-wrap: no-wrap; align-items:center"> <a href="/leadview/' + row.leadid + '" class="edit btn btn-success btn-sm">View</a> <a href="callto:'+ row.phonenumber +'" class="edit btn btn-secondary mx-4 btn-sm">Call</a></div>'
                }
            }

        ]
    });
    }

    $('#search').click(function(){
        var from_date = $('#from').val();
        var to_date = $('#to').val();

        if(from_date != '' &&  to_date != '')
        {
            $('.user_datatable').DataTable().destroy();
            fetchtransaction(from_date, to_date);
        }
        else
        {
            alert('Both Date is required');
        }
        });
           
});
</script>
@endsection