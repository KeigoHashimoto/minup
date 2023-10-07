@extends('layouts.app')

@section('content')
    {{ Form::open(['route'=>'fixedCost.store','class'=>'form']) }}
    <h2 class="center-title">固定費の作成</h2>
            <div class="form-group">
                {{ Form::label('cost-title','固定費名') }}
                {{ Form::text('cost-title',null,['class'=>'form-control','placeholder'=>'(例)生活固定費 etc']) }}
            </div>
        <div id="fixed-cost-expenses">
            <fixed-cost-expense></fixed-cost-expense>
        </div>

        <div class="form-group">
            {{ Form::submit('固定費を作成',['class'=>'form-control submit']) }}
        </div>

        <p>{!! link_to_route('budget.index','ホームへ',[],['class'=>'small']) !!}</p>
    {{ Form::close() }} 
@endsection