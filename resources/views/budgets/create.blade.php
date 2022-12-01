@extends('layouts.app')

@section('content')
    {{ Form::open(['route'=>'budget.store','class'=>'form']) }}
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
            {{ Form::label('month','日付') }}
            {{ Form::date('month',null,['class'=>'form-control','placeholder'=>'(例)何月の予算かを入力してください']) }}
        </div>

        <div class="form-group">
            {{ Form::submit('予算を作成',['class'=>'form-control submit']) }}
        </div>

        <p>{!! link_to_route('budget.index','ホームへ',[],['class'=>'small']) !!}</p>
    {{ Form::close() }}

@endsection