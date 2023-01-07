@extends('layouts.app')

@section('content')
<h2 class="center">出費の編集</h2>
    <div id="expense-edit">
        {{ Form::model($expense,['route'=>['expense.update',$expense->id],'method'=>'put']) }}
            <div class="form-group">
                {!! Form::label('content','用途') !!}
                {!! Form::text('content',null,['class'=>'form-control']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::label('expense','出費') !!}
                {!! Form::text('expense',null,['class'=>'form-control']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::submit('編集',['class'=>'form-control submit']) !!}
            </div>
        {{ Form::close() }}
    </div>

    <a href="{{ route('budget.show',$expense->budget->id) }}" class="center small">戻る</a>
@endsection
