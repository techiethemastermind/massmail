<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'NFT Analytics') }}</title>

    <link rel="icon" type="image/png" href="#">

    <!-- Twitter summary card with large image must be at least 280x150px -->

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('assets/css/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- Fix Footer CSS -->
    <link type="text/css" href="{{ asset('assets/css/fix-footer.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('assets/css/material-icons.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link type="text/css" href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet">

    <!-- Preloader -->
    <link type="text/css" href="{{ asset('assets/css/preloader.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link type="text/css" href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link type="text/css" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    @stack('after-styles')

</head>

<body class="layout-sticky-subnav layout-default ">

    <!-- Pre Loader -->
    <div class="preloader">
        <div class="sk-double-bounce">
            <div class="sk-child sk-double-bounce1"></div>
            <div class="sk-child sk-double-bounce2"></div>
        </div>
    </div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">
        @include('layouts.backend.nav')

        <!-- Main Content -->
        @yield('content')

        <!--footer -->
        @include('layouts.backend.footer')
    </div>

    @if(auth()->check())
        <!-- Side bar -->
        @include('layouts.backend.sidebar')
    @endif

<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Perfect Scrollbar -->
<script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>

<!-- DOM Factory -->
<script src="{{ asset('assets/js/dom-factory.js') }}"></script>

<!-- MDK -->
<script src="{{ asset('assets/js/material-design-kit.js') }}"></script>

<!-- Fix Footer -->
<script src="{{ asset('assets/js/fix-footer.js') }}"></script>

<!-- App JS -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Global Settings -->
<script src="{{ asset('assets/js/settings.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>

<!-- jQuery Form -->
<script src="{{ asset('assets/js/jquery.form.min.js') }}"></script>

<script>
    // Ajax header for Ajax POST
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>

@stack('after-scripts')

@include('layouts.parts.sweet-alert')

<!-- Global Helper Script -->
<script src="{{ asset('assets/js/helper.js') }}"></script>

<script>
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function (stream) {
                // swal('Success!', 'Camera Enabled', 'success');
            })
            .catch(function (err0r) {
                // swal('Error!', 'No camera supported in your browser.', 'error');
            });
    }
</script>

</body>

</html>