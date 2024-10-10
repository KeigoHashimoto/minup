@extends('layouts.app')

@section('content')
    <div id="chart">
        <chart-disp :expenses="{{ json_encode($expenses) }}"></chart-disp>
    </div>
@endsection
