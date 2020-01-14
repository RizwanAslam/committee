<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title')
    </title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="{{ asset('assets/favicon.png') }}" rel="shortcut icon">
    <link href="{{asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/flatpickr.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('assets/icon_fonts_assets/feather/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/dt/dataTables.bootstrap4.css') }}">
    <style>
        @yield('style')
    </style>
    <style>
        .active-sidebar {
            border-radius: 4px;
            color: lightslategray !important;
            background-color: whitesmoke;
        }
    </style>
</head>
<body>
<div id="app" class="all-wrapper menu-side">

    <div class="layout-w">
        @include('admin.layout.partials.sidebar')
        <div class="content-w">
            @yield('content')
        </div>
    </div>
</div>


<script src="{{mix('js/app.js')}}"></script>
<script src="{{asset('assets/bower_components/moment/moment.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap-validator/dist/validator.min.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/js/flatpickr4.2.3flatpickr.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="{{ asset('/assets/dt/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{asset('/assets/dt/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('assets/bower_components/tether/dist/js/tether.min.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap/js/dist/button.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap/js/dist/carousel.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap/js/dist/collapse.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap/js/dist/dropdown.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap/js/dist/modal.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap/js/dist/tooltip.js')}}"></script>
<script src="{{asset('assets/bower_components/bootstrap/js/dist/popover.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

@yield('script')
</body>
</html>
