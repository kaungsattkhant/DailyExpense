$(function (){
    $('#usage_filter').on('click',function (){
        var from=$('#from_date').datepicker('getDate');
        var to=$('#to_date').datepicker('getDate');
        if(from !=null && to!=null){
            var from_date=$('#from_date').val();
            var to_date=$('#to_date').val();
            $.ajax({
                url:'/daily_usage/filter_usage',
                type:'get',
                data:{
                    from_date:from_date,
                    to_date:to_date,
                },
                success:function (response){
                    console.log(response);
                    $('#daily_usage').html(response);
                    // console.log(response);
                }
            });
        }else{
            setTimeout(function(){
                $('#msg').html(" <span  class='hel bg-danger'><b> Error!</b>Please choose Date  </span>")
                }, 1000);
            setTimeout(function(){
                $('#msg').hide()
            }, 5000);
            // $('#msg').show();

            // alert('Please Choose Date');

        }
    });

        // $('#canvas_filter').hide();
        // $('#canvas').show();
        // var ctx = document.getElementById("canvas").getContext('2d');
        // // var currency=$.parseJSON($currency);
        // var days=$.parseJSON($days);
        // // var avg_rate=$.parseJSON($avg_rate);
        // var myChart = new Chart(ctx, {
        //     type: 'bar',
        //     data: {
        //         labels:days,
        //         datasets: [{
        //             label: 'Daily Expensive',
        //             data: '',
        //             borderWidth: 1,
        //             backgroundColor: 'rgba(0, 119, 204, 0.8)',
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                     suggestedMin: 50,
        //                     suggestedMax: 100
        //                 }
        //             }]
        //         }
        //     }
        // });
        // // ****************end chart*******************
        // // var ctx_filter = document.getElementById("canvas_filter").getContext('2d');
        // // var currency=$.parseJSON($currency);
        // // var days=$.parseJSON($days);
        // // var avg_rate=$.parseJSON($avg_rate);
        // //
        // // var chart_filter = new Chart(ctx_filter, {
        // //     type: 'bar',
        // //     data: {
        // //         labels:days,
        // //         datasets: [{
        // //             label: 'Daily Expensive',
        // //             data: avg_rate,
        // //             borderWidth: 1,
        // //             backgroundColor: 'rgba(0, 119, 204, 0.8)',
        // //         }]
        // //     },
        // //     options: {
        // //         scales: {
        // //             yAxes: [{
        // //                 ticks: {
        // //                     suggestedMin: 50,
        // //                     suggestedMax: 100
        // //                 }
        // //             }]
        // //         }
        // //     }
        // // });
        // // **************************chart_filter******************
        // $('#rate_report_filter').click(function () {
        //     var currency_id=$('#currency_filter').val();
        //     var month=$('#month_filter').val();
        //     var year=$('#year_filter').val();
        //     var rate_type=$('#rate_type').val();
        //     $.ajax({
        //         url:'/report/rate_comparison_filter',
        //         type:'get',
        //         data:{
        //             currency:currency_id,
        //             month:month,
        //             year:year,
        //             rate_type:rate_type,
        //         },
        //         success:function (response) {
        //             $('#canvas_filter').show();
        //             $('#canvas').hide();
        //             update_rate(chart_filter,response.days,response.avg_rate,response.label);
        //             console.log(response.days);
        //             console.log(response.avg_rate);
        //             console.log('success');
        //         }
        //     });
        // });

});
// function update_rate(chart,days,avg_rate,label) {
//     chart.data.labels=days;
//     chart.data.datasets[0].data = avg_rate;
//     chart.data.datasets[0].label = label;
//     chart.update();
// }
$(document).on('click', '.pagination a', function(event){
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    var from=$('#from_date').datepicker('getDate');
    var to=$('#to_date').datepicker('getDate');

    if(from !=null && to!=null){
        filter(page)
    }else{
        fetch_data(page);

    }
});
function filter(page){
    var from_date=$('#from_date').val();
    var to_date=$('#to_date').val();
    $.ajax({
        url:'/daily_usage/filter_usage?page='+page,
        data:{
            from_date:from_date,
            to_date:to_date,
        },
        type:'get',
        success:function (data) {
            $('#daily_usage').html(data);
        }
    });
}

function fetch_data(page)
{

    $.ajax({
        url:"/daily_usage?page="+page,
        type:'get',
        success:function(data)
        {
            $('#daily_usage').html(data);
        }
    });
}
