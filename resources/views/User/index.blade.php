@extends('Layouts.master')
@section('content')
    <div class="content">
{{--        <div class="alert alert-success">--}}
{{--            @php--}}
{{--             $user=\Illuminate\Support\Facades\Auth::user();--}}
{{--            @endphp--}}
{{--            <strong>Login Success!</strong> <i>User =>{{$user->name}}  ||  Login Year=>{{Session::get('year')}}</i>--}}
{{--            <button type="button" class="close mb-0" data-dismiss="alert" aria-hidden="true">×</button>--}}
{{--        </div>--}}
        <div class="pt-4 mt-auto" id="staff_filter">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection

