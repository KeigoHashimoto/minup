<div id="expence-edit">
    {{ Form::model($expense,['route'=>['expense.update',$expense->id],'method'=>'put','class'=>'expense-form']) }}
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