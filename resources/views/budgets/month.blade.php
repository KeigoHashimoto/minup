@extends('layouts.app')

@section('content')
    <h1 class="center-title">月別予算一覧</h1>

    @if($budgets_month->isEmpty())
        <p>まだ一度も予算が登録されていません</p>
    @else
        @foreach($budgets_month as $budget_month)
            {!! link_to_route('budget.monthShow',$budget_month->new_month,[$budget_month->new_month],['class'=>'month']) !!}
        @endforeach
    @endif
@endsection