
    @if(empty($budgets))
        <p class="center-title alert">まだ予算が登録されていません！</p>
    @else
        @foreach($budgets as $budget)
            <div class="index-budget">
                <div class="budget-title">
                    <small>{{ $budget->year."年".$budget->month."月" }}  {{$budget->name}}の投稿</small>
                    {!! link_to_route('budget.show','【'.$budget->title.'】',[$budget->id],['class'=>'budget']) !!}
                </div>
                <div class="budget-btns">   
                    <a href="{{ route('budget.edit',$budget->id) }}" class="edit"><i class="fas fa-pen"></i></a>
                    {{ Form::open(['route'=>['budget.delete',$budget->id],'method'=>'delete']) }}
                        {{ Form::button('<i class="fas fa-trash"></i>',['class'=>'delete','type'=>'submit','onClick'=>'return deleteBtn();']) }}
                    {{ Form::close() }}
                </div>
            </div>  
        @endforeach
    @endif
