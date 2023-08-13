@extends('layouts.app')

@section('content')

<div class="tasks">
    <div id="task-icon">
        <i class="fas fa-tasks"></i>
    </div>

    <div id="tasks-form">
        {{ Form::open(['route'=>'task.post']) }}
            <div class="form-group">
                {{ Form::label('task','買うもの') }}
                {{ Form::text('task',null,['class'=>'form-control']) }}
            </div>
            <div class="task-mini-form">
                <div class ="form-group">
                    {{ Form::label('quantity','個数(任意)') }}
                    <div>{{ Form::number('quantity',null,['class'=>'form-control']) }}個</div>
                </div>
                <div class ="form-group">
                    {{ Form::label('taskBudget','予算(任意)') }}
                    <div>{{ Form::number('taskBudget',null,['class'=>'form-control']) }}円</div>
                </div>
            </div>
            {{ Form::submit('タスクの作成',['class'=>'submit form-control']) }}
        {{ Form::close() }}
    </div>

    @if($tasks->isEmpty())
        <p class="center-title alert">書いたいものがありません。右下のアイコンから買いたいものを追加してください。</p>
    @else
    
        <h3 class="list-title">買いたいものリスト</h3>
        @foreach($tasks as $task) 
            @if($task->status == 0)
                
                <div class="tasks-index">
                    {{-- 買うものの内容 --}}
                    <p class="task">{{ $task->task }}</p>

                    @if($task->quantity)
                        <p>個数：<br>{{ $task->quantity }}</p>
                    @endif

                    @if($task->taskBudget)
                        <p>予算：<br>{{ $task->taskBudget }}円</p>
                    @endif

                    {{-- 購入済みボタン --}}
                    {{ Form::open(['route'=>['task.status',$task->id]]) }}
                        {{ Form::button('<i class="fas fa-check-circle"></i>',['class' => 'check','type'=>'submit']) }}
                    {{ Form::close() }}

                    {{-- 削除ボタン --}}
                    {{ Form::open(['route'=>['task.delete',$task->id],'method'=>'delete']) }}
                        {{ Form::button('<i class="fas fa-trash"></i>',['class'=>'delete','type'=>'submit','onClick' => 'return deleteBtn()']) }}
                    {{ Form::close() }}
                </div>
            @endif
        @endforeach

        <h3 class="list-title mt-3">購入済みリスト</h3>
        @foreach($tasks as $task)
            @if($task->status == 1)
                <div class="tasks-index">   
                    {{-- 買ったものの内容 --}}
                    <p class="task">{{ $task->task }}</p>
                    @if($task->quantity)
                        <p>個数：{{ $task->quantity }}</p>
                    @endif
                    {{-- 未購入ボタン --}}
                    {{ Form::open(['route'=>['task.status',$task->id]]) }}
                        {{ Form::button('<i class="fas fa-check-circle"></i>',['class'=>'no-check','type'=>'submit']) }}
                    {{ Form::close() }}

                    {{-- 削除ボタン --}}
                    {{ Form::open(['route'=>['task.delete',$task->id],'method'=>'delete']) }}
                        {{ Form::button('<i class="fas fa-trash"></i>',['class'=>'delete','type'=>'submit','onClick' => 'return deleteBtn();']) }}
                    {{ Form::close() }}
                </div>
            @endif
        @endforeach
    @endif

    <div class="filter"></div>

</div>

@endsection