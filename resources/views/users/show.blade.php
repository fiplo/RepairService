@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills card-header-pills nav-justified">
                <li class="nav-link">
                    <a href="/register" class="btn btn-primary">Sukurti Nauja Vartotoją</a>
                </li>
                <li class="nav-link">
                    <a href="/order/show" class="btn btn-primary">Užsakymų sąrašas</a>
                </li>
            </ul>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Vardas</th>
                    <th scope="col">Tipas</th>
                    <th scope="col">Profilis</th>
                    <th scope="col">Užsakymai</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->type}}
                    </td>
                    <td>
                        <a href="/user/{{$user->id}}">
                            Atidaryti profilį
                        </a>
                    </td>
                    <td>
                        <a href="#ordersCollapse{{$user->id}}" class="btn btn-primary" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="ordersCollapse{{$user->id}}">Išskleisti užsakymus</a>
                        <span class="badge badge-primary badge-pill">{{$user->order->count()}}</span>
                    </td>
                </tr>
                <tr>
                    <td colspan=5>
                        <div class="collapse pt-3" id="ordersCollapse{{$user->id}}">
                            <table class="table">
                            <tbody>
                            @foreach ($user->order as $order)
                            <tr>
                                <th scope="row">
                                    {{$order->id}}
                                </th>
                                <td>
                                    {{$order->name}}
                                </td>
                                <td>
                                    {{$order->status}}
                                </td>
                                <td>
                                    <a href="/order/{{$order->id}}">Atidaryti</a>
                                </td>
                            </th>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
