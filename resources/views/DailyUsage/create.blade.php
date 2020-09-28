@extends('Layouts.master')
@section('content')
    <div class="container">
        <div>
                <h3>Daily Usage</h3>
        </div>
        <div class="daily_div ">
            <form action="{{url('daily_usage/store')}}" method="post">
                @csrf
                <div class="mb-5">
                    <label class="w-25"> <h4>Title</h4></label>
                    <input type="text"  autocomplete="off" name="title" class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-6"  @focus="modal=true">
                </div>
                <div class="mb-5">
                    <label class="w-25"> <h4>Date</h4></label>
                    <input type="text"  id="hellopicker" autocomplete="off" name="date"  class=" date border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-6"  @focus="modal=true">
                </div>
                <div class="mb-5">
                    <label class="w-25" > <h4>Status</h4></label>
                    <select name="status" class="form-control-sm show-menu-arrow  bd-bottom-mount bg-white col-md-6">
                        <option value="In">IN</option>
                        <option value="Out">Out</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label class="w-25"> <h4>Amount</h4></label>
                    <input type="number" min="0"  autocomplete="off" name="amount"  class="border-top-0 border-right-0 border-left-0 rounded-0 mount-input col-md-6"  @focus="modal=true">
                </div>
                <div class="mb-4" >
                    <button type="submit" class="btn btn-default cs-btn  " >Save.. </button>
                </div>
            </form>

        </div>
    </div>
@endsection
