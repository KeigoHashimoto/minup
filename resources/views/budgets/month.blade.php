@extends('layouts.app')

@section('content')
    <h1 class="center-title">月別予算一覧</h1>

    @if($budgets_month->isEmpty())
        <p class="center-title alert">まだ一度も予算が登録されていません</p>
    @else
        @foreach($budgets_month as $budget)
            {!! link_to_route('budget.monthShow',$budget->year."/".$budget->month,[$budget->year,$budget->month],['class'=>'month']) !!}
        @endforeach
    @endif
@endsection