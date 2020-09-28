<html>
<head>
    <title>Sale Invoice - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
</head>
<body class="login_body">
<div class="main-container">
    <div class="login_div">
        <div class="col-lg-5">

            <div class="login_form">
                <div class="mb-4 pt-4 pl-5 pb-3 ">
                    {{--                    <h4><b><i>Pharmacy Management</i></b></h4>--}}
                    <h4><b><i>Login</i></b></h4>
                </div>
                <form action="{{url('login')}}" method="post">
                    @csrf
                    <div class="mb-4 pb-2 login">
                        {{-- <label for="#name123" class="w-25">Name</label>--}}
                        <input type="text" autocomplete="off" placeholder=" email" name="email" class="" style="border-radius: 10px">
                        {{--<input type="number" id="price"  min="0" name="price" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input">--}}
                    </div>
                    <span class="text-danger" id="name_error">
                                </span>
                    <div class="mb-3 pb-3 login">
                        <input type="password"  name="password" placeholder=" password" style="border-radius: 10px">
                    </div>
{{--                    <div class="mb-3 pb-3 login">--}}
{{--                        <input type="text"  name="login_year" placeholder=" login year" style="border-radius: 10px">--}}
{{--                    </div>--}}
                    <div class="ml-lg-5 pl-1">
                        <button style="width: 100px;border-radius: 10px;border:none;text-decoration: none;outline: none">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" ></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
</html>
