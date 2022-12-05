@extends('layouts.app')

@section('content')
<h1 class="center-title">{{ '【'.$budget->title.'】' }}の予算：<br>{{ $budget->budget }}円</h1>


{{ Form::open(['route'=>['expenses.post',$budget->id],'class'=>'expense-form']) }}
    <div class="form-group">
        {!! Form::label('content','用途') !!}
        {!! Form::text('content',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('expense','出費') !!}
        {!! Form::text('expense',null,['class'=>'form-control']) !!}
    </div>

    {!! Form::submit('登録',['class'=>'form-control submit']) !!}
{{ Form::close() }}

<table>
    <thead>
        <tr>
            <th>用途</th>
            <th>出費</th>
            <th>日時</th>
            <th>削除</th>
            <th>編集</th>
        </tr>
    </thead>

    <tbody>       
        @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->content }}</td>
                <td>{{ $expense->expense }}</td>
                <td>{{ $expense->created_at }}</td>
                <td>{{ Form::open(['route'=>['expense.delete',$expense->id],'method'=>'delete']) }}
                        {{ Form::submit('削除',['class'=>'delete','onClick' => 'return deleteBtn();']) }}
                    {{ Form::close() }}
                </td>
                <td>{!! link_to_route('expense.edit','編集',$expense->id,['class'=>'edit']) !!}</td>
            </tr>
        @endforeach     
    </tbody>
</table>

<p class="center-title">現在使用金額：{{ $sum }}円</p>

<h3 class="remaining">残り：
    @if($budget->budget-$sum <= 5000 && $budget->budget-$sum >= 0)
        <span class="pinch">{{ $budget->budget-$sum }}円</span>
    @elseif ($budget->budget-$sum < 0)
        <span class="out">{{ $budget->budget-$sum }}円</span>
    @else
        {{ $budget->budget-$sum }}円
    @endif
</h3>    

<div class="report">
    {{ Form::open(['route'=>['budget.report',$budget->id],'method'=>'get']) }}
        {{ Form::submit('帳票出力',['class'=>'report-btn']) }}
    {{ Form::close() }}
</div>

{!! link_to_route('budget.index','予算一覧に戻る',[],['class'=>'small']) !!}

@endsection