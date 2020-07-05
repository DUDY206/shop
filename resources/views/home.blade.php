@extends('layouts.app')

@section('content')
    <landing-page :products="{{$products}}"></landing-page>
@endsection
