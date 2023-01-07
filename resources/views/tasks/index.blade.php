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
                {{ Form::text('task',null) }}
            </div>
            <div class ="form-group">
                {{ Form::label('quantity','個数') }}
                {{ Form::number('quantity',null) }}
            </div>
            {{ Form::submit('タスクの作成',['class'=>'submit form-control']) }}
        {{ Form::close() }}
    </div>

    @if($tasks->isEmpty())
        <p class="center-title alert">タスクがありません。右下のアイコンからタスクを追加してください。</p>
    @else
    
        <h3>買いたいものリスト</h3>
        @foreach($tasks as $task) 
            @if($task->status == 0)
                
                <div class="tasks-index">
                    {{ Form::open(['route'=>['task.delete',$task->id],'method'=>'delete']) }}
                        {{ Form::button('<i class="fas fa-check"></i>',['class'=>'check','type'=>'submit']) }}
                    {{ Form::close() }}

                    <div>
                        <p class="task">{{ $task->task }}</p>
                        <p>{{ $task->quantity }}</p>
                    </div>

                    {{ Form::open(['route'=>['task.status',$task->id]]) }}
                        {{ Form::button('購入済みへ',['type'=>'submit']) }}
                    {{ Form::close() }}
                </div>
            @endif
        @endforeach

        <h3>購入済みリスト</h3>
        @foreach($tasks as $task)
            @if($task->status == 1)
                
                <div class="tasks-index">   
                    {{ Form::open(['route'=>['task.delete',$task->id],'method'=>'delete']) }}
                        {{ Form::button('<i class="fas fa-check"></i>',['class'=>'check','type'=>'submit']) }}
                    {{ Form::close() }}

                    <div>
                        <p class="task">{{ $task->task }}</p>
                        <p>{{ $task->quantity }}</p>
                    </div>

                    {{ Form::open(['route'=>['task.status',$task->id]]) }}
                        {{ Form::button('未購入へ',['type'=>'submit']) }}
                    {{ Form::close() }}
                </div>
            @endif
        @endforeach
    @endif

</div>

@endsection