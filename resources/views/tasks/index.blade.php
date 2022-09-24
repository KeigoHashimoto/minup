@extends('layouts.app')

@section('content')

<div class="tasks">
    <div class="tasks-form">
        {{ Form::open(['route'=>'task.post']) }}
            {{ Form::textarea('task',null,['class'=>'textarea']) }}
            {{ Form::submit('タスクの作成',['class'=>'submit form-control']) }}
        {{ Form::close() }}
    </div>

    @foreach($tasks as $task)
        
        <div class="tasks-index">
            {{ Form::open(['route'=>['task.delete',$task->id],'method'=>'delete']) }}
                {{ Form::button('完了',['class'=>'delete','type'=>'submit']) }}
            {{ Form::close() }}

            <p class="task">{{ $task->task }}</p>
        </div>
    @endforeach

</div>

@endsection