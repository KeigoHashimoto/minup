
    @if(empty($budgets))
        <p class="center-title alert">まだ予算が登録されていません！</p>
    @else
        @foreach($budgets as $budget)
            <div class="index-budget">
                <div class="budget-title">
                    <small>{{ $budget->year."年".$budget->month."月" }}</small>
                    {!! link_to_route('budget.show','【'.$budget->title.'】',[$budget->id],['class'=>'budget']) !!}
                </div>
                <div class="budget-btns">
                    {!! link_to_route('budget.edit','編集',[$budget->id],['class'=>'small edit']) !!}
                    {{ Form::open(['route'=>['budget.delete',$budget->id],'method'=>'delete']) }}
                        {{ Form::submit('削除',['class'=>'delete small default','onClick'=>'return deleteBtn();']) }}
                    {{ Form::close() }}
                </div>
            </div>  
        @endforeach
    @endif
