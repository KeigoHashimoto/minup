@extends('layouts.app')

@section('content')
    {{ Form::model($budget,['route'=>['budget.update',$budget->id],'method'=>'put','class'=>'form']) }}
    <h2 class="center-title">予算の作成</h2>
        <div class="form-group">
            {{ Form::label('title','予算名') }}
            {{ Form::text('title',null,['class'=>'form-control','placeholder'=>'(例)食費、雑費etc']) }}
        </div>
        <div class="form-group">
            {{ Form::label('budget','予算') }}
            {{ Form::number('budget',null,['class'=>'form-control','placeholder'=>'(例)30000円の場合→30000']) }}
        </div>

        <div class="form-group">
            {{ Form::label('month','予算月') }}
            <p>
                {{ Form::number('year',null) }}年{{ Form::number('month',null,['class'=>'month-form']) }}月分
            </p>
        </div>

        <div class="form-group">
            {{ Form::submit('予算を更新',['class'=>'form-control submit']) }}
        </div>

        <p>{!! link_to_route('budget.index','ホームへ',[],['class'=>'small']) !!}</p>
    {{ Form::close() }}



@endsection