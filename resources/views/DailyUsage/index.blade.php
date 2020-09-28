@extends('Layouts.master')
@section('content')
    <div class="content">
        <h3 > Daily Expense List</h3>
        <div class=" float-left" id="msg">
        </div>
        <div class="float-right">
            <form action="{{url('daily_usage/create')}}" method="get">
                <button class="btn btn-default cs-btn">Add... </button>
            </form>
        </div>
    </div>
    <div class="row ">
        <hr>
        <div class="col-md-6" style="border-right:3px solid gray;min-height:620px">
            <div class="">
                <div class="mb-3 ">
                    <label class="label">
                        {{--                            <span  class="field">From:</span>--}}
                       From: <input type="text" id="from_date"  autocomplete="off" style=""   name="from_date" class="date border-top-0 border-right-0 border-left-0 badge-dark dtpick-input2 col-md-8" placeholder="YY-MM-DD">
                    </label>
                    <label class="label">
                        {{--                            <span  class="field">From:</span>--}}
                       To: <input type="text" id="to_date"  autocomplete="off" style=""   name="to_dat" class="date border-top-0 border-right-0 border-left-0 badge-dark dtpick-input2 col-md-8" placeholder="YY-MM-DD">
                    </label>
                    <label class="label float-right">
                        <button class="btn btn-default cs-btn" style="height: 35px" id="usage_filter" >Filter </button>
                    </label>
                    <label class="label float-right pr-3" >
{{--                        <form>--}}
                            <button class="btn btn-default cs-btn" style="height: 35px ">Excel </button>
{{--                        </form>--}}
                    </label>
                </div>
{{--                <div class="mb-3 float-left">--}}
{{--                    <label class="label">--}}
{{--                        --}}{{--                            <span  class="field">From:</span>--}}
{{--                        <input type="text" id="hellopicker" onchange="selectDate()" autocomplete="off" style=""   name="from_date" class="date border-top-0 border-right-0 border-left-0  dtpick-input2 col-md-12" placeholder="YY-MM-DD">--}}
{{--                    </label>--}}
{{--                </div>--}}
            </div>
            <div id="daily_usage">
                @include('DailyUsage.filter_daily_usage')
{{--                @foreach($daily_usage as $ds)--}}
{{--                    <div class="card bg-secondary text-white">--}}
{{--                        <div class="card-body"><span class="float-left bg-success" style="padding-left:4px">{{$ds->date}}</span><span class="float-left" style="padding-left:40px;">{{$ds->title}}</span>--}}
{{--                            @if($ds->status=="in")--}}
{{--                                <span class="float-right " style="color:greenyellow">{{$ds->status}}</span>--}}
{{--                            @else--}}
{{--                                <span class="float-right " style="color:red">{{$ds->status}}</span>--}}

{{--                            @endif--}}
{{--                            <span style="padding-right: 40px" class="float-right">{{$ds->amount}}MMK</span> </div>--}}
{{--                    </div>--}}

{{--                    <br>--}}
{{--                @endforeach--}}
{{--                    <p class="ml-5"> {{$daily_usage->links()}}</p>--}}
            </div>
        </div>
        <div class="col-md-6">

            <div>
                <div class="">
                    <div class="mb-3 ">
                        <label class="w-10">Monthly</label>
                        <select  class="form-control-sm show-menu-arrow  bd-bottom-mount col-md-3 badge-dark filter_ml" id="monthly">
{{--                            <option selected disabled value="">Choose Customer</option>--}}
                            @php
                                $months=['January','February','March','April','May','June','July','Augest','September','October','November','December'];

                            @endphp
                            {{--                    <option selected disabled>Month</option>--}}
                            @foreach($months as $key=>$m)
                                <option value="{{$key+1}}" @if(($key+1)== \Carbon\Carbon::now()->month) selected @endif>{{$m}}</option>
                            @endforeach
                        </select>
                        <label class="w-10" >Yearly</label>
                        <select  class="form-control-sm show-menu-arrow  bd-bottom-mount badge-dark col-md-3 filter_ml" id="yearly">
{{--                            <option selected disabled value="">Choose Year</option>--}}
                            @foreach($years as $y)
                                <option value={{$y}} @if(\Carbon\Carbon::now()->year ==$y) selected @endif>{{$y}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                </div>
                <div>
                    <p><b>Total:</b>{{$in}} <span style="color:darkred">MMK</span></p>
                    <p><b>OUT:</b>{{$out}} <span style="color:darkred">MMK</span></p>
                    <p><b>Remain:</b>{{$remain}} <span style="color:darkred">MMK</span></p>
                    <p><b>Average:</b>{{$average}} <span style="color:darkred">MMK</span></p>
                </div>
                <div class="col-md-12 col-md-offset-1 bg-white mt-3 rounded">

                    <div class="panel panel-default">
                        {{--                    <div class="panel-heading"><b>Charts</b></div>--}}
                        <div class="panel-body">
                            <canvas id="canvas" height="280" width="600"></canvas>
                            <canvas id="canvas_filter" height="280" width="600"></canvas>
                        </div>

                    </div>
                </div>

            </div>



        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/usage.js')}}"></script>
    <script>
        $(function (){
            $('#canvas_filter').hide();
            $('#canvas').show();
            var ctx = document.getElementById("canvas").getContext('2d');
            var usage=@json($usage);
            var days=@json($days);
            // var avg_rate=$.parseJSON($avg_rate);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:days,
                    datasets: [{
                        label: 'Daily Expensive',
                        data: usage,
                        borderWidth: 1,
                        backgroundColor: 'rgba(0, 119, 204, 0.8)',
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 50,
                                suggestedMax: 100
                            }
                        }]
                    }
                }
            });
            // ****************end chart*******************
            var ctx_filter = document.getElementById("canvas_filter").getContext('2d');
            // var daily_usage=$.parseJSON($daily_usage);
            // var days=$.parseJSON($days);
            // var avg_rate=$.parseJSON($avg_rate);

            var chart_filter = new Chart(ctx_filter, {
                type: 'bar',
                data: {
                    labels:days,
                    datasets: [{
                        label: 'Daily Expensive',
                        data: daily_usage,
                        borderWidth: 1,
                        backgroundColor: 'rgba(0, 119, 204, 0.8)',
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 50,
                                suggestedMax: 100
                            }
                        }]
                    }
                }
            });
            // **************************chart_filter******************
            $('.filter_ml').click(function () {
                var monthly=$('#monthly').val();
                var yearly=$('#yearly').val();
                $.ajax({
                    url:'/daily_usage/filter_monthly',
                    type:'get',
                    data:{
                        monthly:monthly,
                        yearly:yearly,
                    },
                    success:function (response) {
                        $('#canvas_filter').show();
                        $('#canvas').hide();
                        update_rate(chart_filter,response.days,response.daily_usage);
                        console.log(response.daily_usage);
                        console.log(response.days);
                        // console.log(response.days);
                        // console.log(response.avg_rate);
                        // console.log('success');
                    }
                });
            });
        });
        function update_rate(chart,days,daily_usage) {
            chart.data.labels=days;
            chart.data.datasets[0].data = daily_usage;
            // chart.data.datasets[0].label = label;
            chart.update();
        }
    </script>
@endsection

