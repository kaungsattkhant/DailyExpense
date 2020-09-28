<html>
<head>
    <title>Laravel Testing </title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/jqueryui.min.css')}}">
{{--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
</head>
<body>{{--<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js" integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI=" crossorigin="anonymous"></script>--}}
<div class="main-container" id="app">
    @include('Layouts.sidebar')
    @yield('content')
</div>
</body>
{{--<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>--}}
{{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js" integrity="sha256-DI6NdAhhFRnO2k51mumYeDShet3I8AKCQf/tf7ARNhI=" crossorigin="anonymous"></script>--}}
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
<script src="{{asset('js/jqueryui.min.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/fontawesome.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

{{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
@yield('script')
<script>
$(function () {
{{--var $j = jQuery.noConflict();--}}
$(".date").datepicker({
    // altFormat:"dd-mm-YY",
            dateFormat:'yy-mm-dd',
            changeYear:true,
            changeMonth:true,
            // showButtonPanel: true,
            autoSize: true,
            hideIfNoPrevNext: true,
            yearRange: "1960:2030",
            duration:'slow',
   });
});
</script>



</html>
