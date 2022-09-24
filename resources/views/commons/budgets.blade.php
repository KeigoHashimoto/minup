
    @if(empty($budgets))
        <p>まだ予算が登録されていません！</p>
    @else
        @foreach($budgets as $budget)
            <div class="index-budget">
                <div class="budget-title">
                    {!! link_to_route('budget.show',substr($budget->month,0,-3).'：'.'【'.$budget->title.'】',[$budget->id],['class'=>'budget']) !!}
                </div>
                <div>
                    <div class="budget-buttons">
                        {!! link_to_route('budget.edit','編集',[$budget->id],['class'=>'edit']) !!}
                        {{ Form::open(['route'=>['budget.delete',$budget->id],'method'=>'delete']) }}
                            {{ Form::submit('削除',['class'=>'delete']) }}
                        {{ Form::close() }}   
                    </div>  
                </div>
            </div>  
        @endforeach
    @endif
