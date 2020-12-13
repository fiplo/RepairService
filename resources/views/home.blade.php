@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Sveiki atvyke {{ Auth::user()->name }}</h1>
            <h2 class="card-subtitle text-muted"><a href="/user/{{ Auth::user()->id }}">Redaguoti profilį</a> </h2>
            <div class="pt-4">Užsakymų skaičius: {{ Auth::user()->order->count() }}</div>
        </div>
    </div>
    <div class="list-group pt-4">
        @foreach( Auth::user()->order as $order)
            <div class="pt-2 list-group-item">Uzsakymas #{{$order->id}} <a href="/order/{{$order->id}}">Atidaryti</a></div>
        @endforeach
    </div>
    @if(Auth::user()->type == 'Admin')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Administraciniai įrankiai</h1>
            <div class="pt-4"><a href="/order/show">Užsakymų sąrašas</a></div>
            <div class="pt-4"><a href="/user/show">Vartotojų sąrašas</a></div>
        </div>
    </div>
    @endif
</div>
@endsection

