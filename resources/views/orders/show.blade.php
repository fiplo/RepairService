@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        @can('create', \App\Order::class)

        <div class="card-header">
            <ul class="nav nav-pills card-header-pills nav-justified">
                <li class="nav-link">
                    <a href="/order/create" class="btn btn-primary">Sukurti Nauja Užsakymą</a>
                </li>
                <li class="nav-link">
                    <a href="/user/show" class="btn btn-primary">Vartotojų sąrašas</a>
                </li>
            </ul>
        </div>

        @endcan
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Užsakymo Pavadinimas</th>
                    <th scope="col">Klientas</th>
                    <th scope="col">Vadybinkas</th>
                    <th scope="col">Būsena</th>
                    <th scope="col">Numatyta baigimo data</th>
                    <th scope="col">Nuoroda į užsakymą</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
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
                        @if ($order->user->where('type', 'Manager')->count() > 0 )
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
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
