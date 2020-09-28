@extends('Layouts.master')
@section('content')
    <div class="content">

        <div class="pt-4 mt-auto" id="staff_filter">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Remain Qty</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $pd)
                        <tr>
                            <td></td>
                            <td>{{$pd->name}}</td>
                            <td>{{$pd->category->name}}</td>
                            <td>{{$pd->price}}</td>
                            <td>{{$pd->remain_qty}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$products->links()}}
            </div>
        </div>
    </div>
@endsection
