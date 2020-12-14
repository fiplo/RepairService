@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Sveiki atvyke {{ Auth::user()->name }}</h1>
            <h2 class="card-subtitle text-muted"><a href="/user/{{ Auth::user()->id }}">Redaguoti profilį</a> </h2>
            <div class="pt-4">Užsakymų skaičius: {{ Auth::user()->order->count() }}</div>
            @if(Auth::user()->type == 'Manager')
                <div>
                    <a href="/order/show">Užsakymu sąrašas</a>
                </div>
            @endif
        </div>
    </div>
    @if (Auth::user()->order->count() > 0)
    <table class="table">
            <thead>
                <tr>
                    <th scope="col">Užsakymo id</th>
                    <th scope="col">Užsakymo Pavadinimas</th>
                    <th scope="col">Klientas</th>
                    <th scope="col">Vadybinkas</th>
                    <th scope="col">Būsena</th>
                    <th scope="col">Numatyta baigimo data</th>
                    <th scope="col">Nuoroda į užsakymą</th>
                </tr>
            </thead>
            <tbody>
            @foreach (Auth::user()->order as $order)
                @if($order->status != 'Delivered')
                <tr>
                    <th scope="row">
                        {{$order->id}}
                    </th>
                    <td>
                        {{$order->name}}
                    </td>
                    <td>
                        @if ($order->user->where('type', 'Client')->count() > 0)
                            @php($client = $order->user->where('type', 'Client')->first())
                            <a href="/user/{{$client->id}}">{{$client->name}}</a>
                        @endif
                    </td>
                    <td>
                        @if ($order->user->where('type', 'Manager')->count() > 0)
                            @php($manager = $order->user->where('type', 'Manager')->first())
                            <a href="/user/{{$manager->id}}">{{$manager->name}}</a>
                        @endif
                    </td>
                    <td>
                        {{$order->status}}
                    </td>
                    <td>
                        {{$order->Estimated}}
                    </td>
                    <td>
                        <a href="/order/{{$order->id}}">
                            Atidaryti
                        </a>
                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif
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

