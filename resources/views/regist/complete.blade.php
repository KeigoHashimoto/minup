@extends('layouts.app')

@section('content')
    {{ $user->name }}さんを登録しました。

    <h1>Thanks You!</h1>
    <p>あなたの生活に小さな潤いをもたらしますように。</p>

    {!! link_to_route('budget.index','ホームへ',[],['class'=>'form-control submit']) !!}
@endsection