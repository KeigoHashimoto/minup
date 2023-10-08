@extends('layouts.app')

@section('content')
    <h2 class="center">今月の予算</h2>
    @if(!$budgets->isEmpty())
      @include('commons.budgets')
    @else
      <p class="empty-alert">まだ今月の予算が登録されていません</p>
    @endif
@endsection