@extends('layouts.app')

@section('content')

<div class="tasks">
    <div id="task-icon">
        <i class="fas fa-tasks"></i>
    </div>

    <div id="tasks-form">
        {{ Form::open(['route'=>'task.post']) }}
            {{ Form::textarea('task',null,['class'=>'textarea']) }}
            {{ Form::submit('タスクの作成',['class'=>'submit form-control']) }}
        {{ Form::close() }}
    </div>

    @if($tasks->isEmpty())
        <p class="center-title alert">タスクがありません。右下のアイコンからタスクを追加してください。</p>
    @else
        @foreach($tasks as $task)
            
            <div class="tasks-index">
                {{ Form::open(['route'=>['task.delete',$task->id],'method'=>'delete']) }}
                    {{ Form::button('<i class="fas fa-check"></i>',['class'=>'check','type'=>'submit']) }}
                {{ Form::close() }}

                <p class="task">{{ $task->task }}</p>
            </div>
        @endforeach
    @endif

</div>

@endsection