@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <ul class="list-group list-group-flush">
            @foreach ($orders as $order)
                <li class="list-group-item">Order Number #{{$order->id}}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
