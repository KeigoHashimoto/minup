@extends('layouts.app')

@section('content')
    <div class="regist-complete-greet">
        {{ $user->name }}さんを登録しました。
        <h1>Thanks You!</h1>
        <p>あなたの生活に小さな潤いをもたらしますように。</p>
    </div>

    {!! link_to_route('budget.index','ログインする',[],['class'=>'form-control submit']) !!}
@endsection