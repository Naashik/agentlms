@extends('layouts.layout', ['agent' => $agent])
@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid col-6 col-sm-6  col-md-3 col-lg-3 col-xl-3 col-xxl-3">
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
        <div class="d-flex flex-column mb-8 mt-5 m-4">
            <label class=" m-3">Update Status To :</label>


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

        </div>



        <div class="fv-row mb-8 fs-6">
            <label for="">Lead Name: <b>{{$lead->name}}</b></label>
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
            <input class="form-control bg-transparent" type="date" name="date">
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