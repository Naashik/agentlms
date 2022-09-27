@extends('layouts.layout', ['agent' => $agent])
@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid col-6 col-sm-6  col-md-3 col-lg-3 col-xl-3 col-xxl-3">
    <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button>
    <div class="mt-10 mb-5 px-5">

        <h2 style="font-size:20px">LEAD UPDATE</h2>


        <!--end::Title-->
        <!--begin::Subtitle-->

        <!--end::Subtitle=-->
    </div>



    <!--begin::Content container-->

    <form class="form w-100 px-5 " action="/updatedetails/{{$lead->id}}" method="post">
        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        @csrf


        <!--begin::Heading-->
        <!--begin::Login options-->

        <!--end::Login options-->
        <!--begin::Separator-->

        <!--end::Separator-->
        <!--begin::Input group=-->
        <div class="d-flex flex-column mb-8 mt-5">
            <label class=" m-1">Update Status To :</label>
            <div class="d-flex">
                <div class="form-group">
                    <label class="bg-transparent ">
                        <div class="box fw-bold ">
                            <select name="status" class="form-control">
                                @foreach($statuses as $status)
                                <option value='{{$status->status}}'>{{$status->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </label>
                </div>
            </div>

            <label class=" m-1">Update Retention Status To :</label>


            <div class="d-flex">
                <div class="form-group">
                    <label class="bg-transparent ">
                        <div class="box fw-bold ">
                            <select name="retentionstatus" class="form-control">

                                <option value='Active'>Active</option>
                                <option value='Non Active'>Non Active</option>

                            </select>
                        </div>
                    </label>
                </div>
            </div>

        </div>






        <div class="fv-row mb-8 fs-6">
            <label for="">Name: <b>{{$lead->name}}</b></label>
        </div>

        <div class="fv-row mb-8 d-flex align-items-center">
            <!--begin::User-->
            <input type="text" placeholder="Amount" name="amount" autocomplete="off" class="form-control bg-transparent"
                value={{old('amount')}}>
            <span class="text-danger">@error('amount') {{$message}} @enderror</span>
            <span class="ms-2">
                <b>Rs</b>
            </span>

            <!--end::User-->
        </div>






        <div class="fv-row mb-8">
            <!--begin::User-->
            <input type="text" placeholder="Transaction Details" name="transaction" autocomplete="off"
                class="form-control bg-transparent" value={{old('transaction')}}>
            <span class="text-danger">@error('transaction') {{$message}} @enderror</span>
            <!--end::User-->
        </div>

        <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Reminder Date</label>
            <input class="form-control bg-transparent" type="date" data-date-format="DD MMMM YYYY" name="date">
        </div>

        <div class="d-flex fv-row mb-8">
            <label class="me-6 form-control bg-transparent" for="">Reminder Time</label>
            <input class="form-control bg-transparent" type="time" name="time">
        </div>
        <!--begin::Link-->

        <!--end::Link-->
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <button type="submit" class="btnfile"><i class="fa-sharp fa-solid fa-file-import" style="color:white"></i>
            Update</button>
        <!--end::Submit button-->
        <!--begin::Sign up-->
    </form>



</div>
@endsection
<!--end::Content-->