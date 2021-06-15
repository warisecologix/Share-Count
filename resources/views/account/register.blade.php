@extends('layouts.app')

@section('content')

    @include('component.register.stats')
    @include('component.register.form')
    @include('component.register.footer')

@endsection

@include('component.register.js')
