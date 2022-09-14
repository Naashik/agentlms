<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>EDGE</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, Bootstrap, Bootstrap 5, Angular, VueJs, React, Asp.Net Core, Blazor, Django, Flask &amp; Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="../favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="../plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body data-kt-name="metronic" id="kt_body" class="app-blank app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>
    if (document.documentElement) {
        const defaultThemeMode = "system";
        const name = document.body.getAttribute("data-kt-name");
        let themeMode = localStorage.getItem("kt_" + (name !== null ? name + "_" : "") + "theme_mode_value");
        if (themeMode === null) {
            if (defaultThemeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            } else {
                themeMode = defaultThemeMode;
            }
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root"
        style="background-image: url(../media/misc/lmp-backgroundnew.jpg);background-size: cover;">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column  order-2 order-lg-1" style="background-color:white;opacity:0.85">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form action="{{route('recaptcha')}}" method="post" class="form w-100 " novalidate="novalidate"
                            id="kt_sign_in_form" data-kt-redirect-url="../../demo1/dist/index.html" action="#">
                            @csrf
                            <!--begin::Heading-->
                            <center>
                                <img alt="Logo" src="../media/logos/edge.png" class="h-75px " />
                            </center>
                            <div class="text-center mb-6">

                                <h1 class="text-dark fw-bolder mb-3" style="font-size:40px">EDGE</h1>

                            </div>
                            <!--begin::Heading-->
                            <!--begin::Login options-->

                            <!--end::Login options-->
                            <!--begin::Separator-->

                            <!--end::Separator-->
                            <!--begin::Input group=-->
                            <center>
                                <div class="mb-11"> {!! NoCaptcha::renderJs() !!}{!! NoCaptcha::display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                    <span>
                                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    </span>
                                    @endif

                                </div>
                            </center>

                            <!--end::Input group=-->

                            <!--end::Input group=-->
                            <!--begin::Wrapper-->

                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span>NEXT</span>

                                </button>
                            </div>

                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <footer class=" d-flex mb-2 px-2 page-footer fixed-bottom font-small pt-5"
                    style="color:gray;font-size:10px">
                    <div class="d-flex px-2">
                        <img alt="Logo" src="../media/logos/prag.png" class="h-15px" style="margin-right:0.2rem" />
                        <p class="mb-0 fw-semibold" target="_blank">Engineered by PragICTS | </p>
                    </div>
                    <p class="mb-0 fw-semibold h-1px" target="_blank">https://pragicts.com | edge@pragicts.com</p>
                </footer>
                <!--end::Form-->
                <!--begin::Footer-->

                <!--end::Footer-->
            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->


                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script>
    var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="../plugins/global/plugins.bundle.js"></script>
    <script src="../js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used by this page)-->
    <script src="../js/custom/authentication/sign-in/general.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>