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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category as $ct)
                        <tr>
                            <td></td>
                            <td>{{$ct->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$category->links()}}
            </div>
        </div>
    </div>
@endsection
