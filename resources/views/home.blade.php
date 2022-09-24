@extends('layouts.app')

@section('content')
    @include('commons.budgets')

    @if($budgets->isEmpty())
        <p class="center-title alert">予算を作成してはじめましょう</p>
    @endif
@endsection