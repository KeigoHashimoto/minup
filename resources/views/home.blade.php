@extends('layouts.app')

@section('content')

    @if(!$budgets->isEmpty()) 
    <h2 class="center">今月の予算</h2>
        @include('commons.budgets')
    @else
        <p class="center">まだ今月分の予算がありません。</p>
    @endif

@endsection