@extends('Layouts.master')
@section('content')
    <sale-invoice customers="{{$customers}}"></sale-invoice>
@endsection
