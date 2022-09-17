@extends('layouts.layout', ['agent' => $agent])
@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid col-6 col-sm-6  col-md-3 col-lg-3 col-xl-3 col-xxl-3">
    <!--begin::Content container-->

    <form class="form w-100 px-5 " action="/updatelead/{{$lead->id}}" method="post">
        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        @csrf

        <div class="mb-10">

            <h2 style="font-size:20px">Lead Update </h2>


            <!--end::Title-->
            <!--begin::Subtitle-->

            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->
        <!--begin::Login options-->

        <!--end::Login options-->
        <!--begin::Separator-->

        <!--end::Separator-->
        <!--begin::Input group=-->

        <div class="fv-row mb-8">
            <!--begin::User-->
            <input type="text" placeholder="Name" name="name" autocomplete="off" class="form-control bg-transparent"
                value="">
            <span class="text-danger">@error('name') {{$message}} @enderror</span>
            <!--end::User-->
        </div>

        <div class="fv-row mb-8">
            <!--begin::User-->
            <input type="text" placeholder="Name" name="name" autocomplete="off" class="form-control bg-transparent"
                value="">
            <span class="text-danger">@error('name') {{$message}} @enderror</span>
            <!--end::User-->
        </div>

        <div class="fv-row mb-8">
            <!--begin::User-->
            <input type="text" placeholder="Name" name="name" autocomplete="off" class="form-control bg-transparent"
                value="">
            <span class="text-danger">@error('name') {{$message}} @enderror</span>
            <!--end::User-->
        </div>
        <!--begin::Link-->

        <!--end::Link-->
        <!--end::Wrapper-->
        <!--begin::Submit button-->
        <label>Update Status To :</label>
        <div class="d-flex mb-8 mt-5">


            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span class="indicator-label">Work in progress</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                <!--end::Indicator progress-->
            </button>

        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->

    </form>
</div>
@endsection
<!--end::Content-->