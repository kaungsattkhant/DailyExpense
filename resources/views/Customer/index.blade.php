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
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $cs)
                        <tr>
                            <td></td>
                            <td>{{$cs->name}}</td>
                            <td>{{$cs->email}}</td>
                            <td>{{$cs->phone_number}}</td>
                            <td>{{$cs->address}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$customers->links()}}
            </div>
        </div>
    </div>
@endsection
