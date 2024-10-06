@extends('layouts.app')

@section('content')
    <h1 class="center-title">固定費一覧</h1>

    @if($costs->isEmpty())
        <p class="center-title alert">まだ一度も予算が登録されていません</p>
    @else
        @foreach($costs as $cost)
        <table>
            <thead>
                <tr>
                    <th>固定費タイトル</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$cost->cost_title}}</td>
                    <td>編集</td>
                    <td>
                        {{ Form::open(['route' => 'fixedCost.delete', 'method' => 'POST'])}}
                        @csrf
                            {{ Form::hidden('id', $cost->id)}}
                            {{ Form::button('<i class="fas fa-trash"></i>',['class'=>'delete','type'=>'submit','onClick'=>'return deleteBtn();']) }}
                        {{ Form::close()}}
                    </td>
                </tr>
            </tbody>
        </table>
        {!! link_to_route('fixedCreate.form','固定費作成',[],['class'=>'small']) !!}
        {!! link_to_route('budget.index','ホームへ',[],['class'=>'small']) !!}
        @endforeach
    @endif
@endsection