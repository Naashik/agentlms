@extends('layouts.layout', ['agent' => $agent])
@section('content')
@section('home_select','active')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->

                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->

                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->

                                <!--end::Actions-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->

                        <div id="kt_app_content" class="app-content">
                            <!--begin::Content container-->

                            <div id="kt_app_content_container" class="app-container container-fluid">
                                <!--begin::Row-->
                                <div class="row g-10 g-xl-10">
                                    <!--begin::Col-->
                                    <div class="col-md-6 col-lg-6 col-xxl-2">
                                        <!--begin::Card widget 20-->
                                        <a href="/agentdashboard">
                                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10"
                                                style="background-color: #1E1E2D;background-image:url('assets/media/patterns/vector-1.png')">
                                                <!--begin::Header-->

                                                <div class=" pt-5 justify-content-center">
                                                    <!--begin::Title-->
                                                    <div class="card-title d-flex flex-column align-items-center">
                                                        <!--begin::Amount-->

                                                        <span
                                                            class="text-white opacity-75 pt-1 fw-semibold fs-1 mb-5 ">Leads</span>

                                                        <img src="../media/logos/users.png"
                                                            class="mb-7 border-bottom border-3">
                                                     
                                                        <!--end::Subtitle-->
                                                    </div>


                                                    <!--end::Title-->
                                                </div>

                                                <!--end::Header-->
                                                <!--begin::Card body-->

                                                <!--end::Card body-->
                                            </div>
                                        </a>
                                        <!--end::Card widget 20-->
                                        <!--begin::Card widget 7-->

                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xxl-2">
                                        <!--begin::Card widget 20-->
                                        <a href="/leadtransactionview">
                                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10"
                                                style="background-color: #1E1E2D;background-image:url('assets/media/patterns/vector-1.png')">
                                                <!--begin::Header-->

                                                <div class=" pt-5 justify-content-center">
                                                    <!--begin::Title-->
                                                    <div class="card-title d-flex flex-column align-items-center">
                                                        <!--begin::Amount-->

                                                        <span
                                                            class="text-white opacity-75 pt-1 fw-semibold fs-1 mb-5 ">Transactions</span>

                                                        <img src="../media/logos/users.png"
                                                            class="mb-7 border-bottom border-3">
                                                  
                                                        <!--end::Subtitle-->
                                                    </div>
                                                    <!--end::Title-->
                                                </div>

                                                <!--end::Header-->
                                                <!--begin::Card body-->

                                                <!--end::Card body-->
                                            </div>
                                        </a>
                                        <!--end::Card widget 20-->
                                        <!--begin::Card widget 7-->

                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                    <!--end::Content-->
                </div>






@endsection