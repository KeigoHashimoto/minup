@extends('layouts.app')

@section('content')

    @if(!$budgets->isEmpty()) 
        @include('commons.budgets')
    @else
        <p>予算を作成してください</p>
    @endif

@endsection