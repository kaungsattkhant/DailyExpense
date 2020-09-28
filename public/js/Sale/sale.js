function selectDate(){
  var date=$('.date').val();
            $.ajax({
                    url: '/sale_invoice/sale_record_filter',
                    type: 'get',
                    data: {
                        date:date,
                    },
                    success: function (response) {
                        $('#sale_filter').html(response);
                    }
                });
}
function detail(id) {
    $.ajax({
        url: '/sale_invoice/detail',
        type: 'get',
        data:{
           id:id,
         },
        success:function (data) {
            $('#detail').modal('show');
            $('div #detail_modal').html(data);
        }
    });
}
