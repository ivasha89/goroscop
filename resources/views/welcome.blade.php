@extends('layout')

@section('title', 'Добро Пожаловать')

@section('content')
    @if ($tkn)
        @include('users.welcomeStatistics')
    @else
        @include('users.check')
    @endif
@endsection
