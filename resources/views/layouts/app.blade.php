<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Recicle') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{ asset('material') }}/css/material-dashboard-pro.css?v=2.1.1" rel="stylesheet" />
    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('css')
</head>
<body class="{{ $class ?? '' }}">
    @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include('layouts.page_templates.auth')
    @endauth
    @guest()
        @include('layouts.page_templates.guest')
    @endguest
    
    <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/pt-br.js"></script>
    <script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
    <script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
    <script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
    <script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'"></script>
    <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
    <script src="{{ asset('material') }}/js/material-dashboard-pro.js?v=2.1.1" type="text/javascript"></script>
    <script src="{{ asset('material') }}/demo/demo.js"></script>
    <script src="{{ asset('material') }}/js/settings.js"></script>
    <script src="https://kit.fontawesome.com/d8dccc68b2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('material') }}/js/app/api.js"></script>
    <script src="{{ asset('material') }}/js/app/app.js"></script>
    <script src="{{ asset('material') }}/js/plugins/jquery.weightMask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('js')
</body>
</html>