@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('title_select','Lead Update')



<div id="kt_app_content" class="app-content flex-column-fluid col-6 col-sm-6  col-md-3 col-lg-3 col-xl-3 col-xxl-3">
 <!--   <button onclick="history.back()" class="btnback mx-5 mt-5"><i class="fa-solid fa-angles-left"
            style="color:white;margin-top:0.2rem"></i></button> -->
            <form class="form w-100 px-5 ms-5" action="/updatelead/{{$lead->id}}" method="post">
                @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf


                <div class="mt-10 mb-5 ">

                    <h2 style="font-size:20px">LEAD UPDATE </h2>


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
                    <input type="text" placeholder="Name" name="name" autocomplete="off"
                        class="form-control bg-transparent" value={{$lead->name}}>
                    <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    <!--end::User-->
                </div>

                <div class="fv-row mb-8">
                    <!--begin::Phone-->
                    <input type="text" placeholder="Phone Number" name="phonenumber" autocomplete="off"
                        class="form-control bg-transparent" value={{$lead->phonenumber}}>
                    <span class="text-danger">@error('phonenumber') {{$message}} @enderror</span>
                    <!--end::Phone-->
                </div>
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="email" placeholder="Email Address" name="email" autocomplete="off"
                        class="form-control bg-transparent" value={{$lead->email}}>
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    <!--end::Email-->
                </div>

                <div class="fv-row mb-8">
                    <!--begin::Account Number-->
                    <input type="text" placeholder="Account Number" name="accountnumber"
                        autocomplete="off" class="form-control bg-transparent"
                        value={{$lead->accountnumber}}>
                    <span class="text-danger">@error('accountnumber') {{$message}} @enderror</span>
                    <!--end::Account Number-->
                </div>



                <div class="form-group mb-8">
                    <select name="countryid" id="country-dd" class="form-control">
                        @if($countrydetail && $country)
                        <option value={{$country->id}}>{{$countrydetail->countryname}}</option>
                        @else
                        <option value="">Select Country</option>
                        @endif

                        @foreach ($countries as $data)
                        <option value="{{$data->id}}">
                            {{$data->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-8">

                    <select name="stateid" id="state-dd" class="form-control">
                        @if($countrydetail && $state)
                        <option value={{$state->id}}>{{$countrydetail->state}}</option>
                        @else
                        <option value="">Select State</option>
                        @endif

                    </select>
                </div>
                <div class="form-group mb-8">
                    <select name="cityid" id="city-dd" class="form-control">
                        @if($countrydetail && $city)
                        <option value={{$city->id}}>{{$countrydetail->city}}</option>
                        @else
                        <option value="">Select City</option>
                        @endif
                    </select>
                </div>


                <div class="fv-row mb-8">
                    <!--begin::User-->
                    <input type="text" placeholder="Position" name="position" autocomplete="off"
                        class="form-control bg-transparent" @if (isset($leaddata))
                        value={{$leaddata->position}} @endif>
                    <span class=" text-danger">@error('position') {{$message}} @enderror</span>
                    <!--end::User-->
                </div>

                <div class="fv-row mb-8">
                    <!--begin::Phone-->
                    <input type="text" placeholder="Phone Number 2" name="phonenumber2"
                        autocomplete="off" class="form-control bg-transparent" @if (isset($leaddata))
                        value={{$leaddata->phonenumber2}} @endif>
                    <span class="text-danger">@error('phonenumber2') {{$message}} @enderror</span>
                    <!--end::Phone-->
                </div>
                <div class="form-group mb-8">
                    @if($leaddata)
                    <select name="leadtype" class="form-control">
                        <option hidden value={{$leaddata->leadtype}}>{{$leaddata->leadtype}}
                        </option>
                        <option value="new">new</option>
                        <option value="experienced">experienced</option>

                    </select>
                    @else
                    <select name="leadtype" class="form-control">

                        <option value="">Select Type</option>
                        <option value="new">new</option>
                        <option value="experienced">experienced</option>

                    </select>
                    @endif

                </div>
                <!--begin::Link-->

                <!--end::Link-->
                <!--end::Wrapper-->
                <!--begin::Submit button-->
                <div class="d-flex mb-8 mt-10">
                    <button type="submit" id="kt_sign_in_submit" class="btnfile"><i
                            class="fa-sharp fa-solid fa-file-import" style="color:white"></i>

                        <!--begin::Indicator label-->
                        <span class="indicator-label">Update Lead</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
                            <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>

                </div>
                <!--end::Submit button-->
                <!--begin::Sign up-->

            </form>



    <!--begin::Content container-->

   

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <script>
    $(document).ready(function() {

        var countryid = document.getElementById("country-dd");
        if (countryid.value != "") {
            $("#state-dd").html('');

            function postajax() {
                return $.ajax({
                    url: "{{url('api/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: countryid.value,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                });
            }
            async function test() {
                try {
                    const res = await postajax();
                    $('#state-dd').html(@if($countrydetail && $city)
                        '<option value={{$state->id}}>{{$countrydetail->state}}</option>'
                        @else '<option value="">Select Type</option>'
                        @endif);
                    $.each(res.states, function(key, value) {
                        $("#state-dd").append('<option value="' + value.id + '">' + value
                            .name + '</option>');
                    });
                } catch (err) {
                    console.log(err);
                }
            }
            test();
        }

    })
    </script>

    <script>
    $(document).ready(function() {
        $('#country-dd').on('change', function() {
            var idCountry = this.value;

            $("#state-dd").html('');
            $.ajax({
                url: "{{url('api/fetch-states')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dd').html('<option value="">Select State</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city-dd').html('<option value="">Select City</option>');
                }
            });
        });
        $('#state-dd').on('change', function() {
            var idState = this.value;
            $("#city-dd").html('');
            $.ajax({
                url: "{{url('api/fetch-cities')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city-dd').html('<option value="">Select City</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city-dd").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
    </script>

@endsection
<!--end::Content-->