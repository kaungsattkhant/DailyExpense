@extends('Layouts.master')
@section('content')
    <div class="content">
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">
                <div class="mb-3 ">
                        <label class="label">
{{--                            <span  class="field">From:</span>--}}
                            <input type="text" id="hellopicker" onchange="selectDate()" autocomplete="off" style=""   name="from_date" class="date border-top-0 border-right-0 border-left-0  dtpick-input2 col-md-12" placeholder="YY-MM-DD">
                        </label>
                </div>
            </div>
            {{--            <div class="float-right">--}}
            {{--                <button class="btn btn-default cs-btn" data-toggle="modal" data-target="#item_create" >Add</button>--}}
            {{--            </div>--}}
        </div>
        <div class="pt-4 mt-auto" id="sale_filter">
            @include('SaleInvoice.sale_record_filter')
        </div>
    </div>
    @include('SaleInvoice.detail_modal')
@endsection
@section('script')
    <script src="{{asset('js/Sale/sale.js')}}">
    </script>
@endsection

