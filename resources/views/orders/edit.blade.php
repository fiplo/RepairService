@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-12 text-center">
        <h2>Užsakymo redagavimas</h2></div>
    </div>
    <form action="/order/{{$order->id}}" method="POST">
        @method('PATCH')
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
                <label for="name" class="col-md-4 col-form-label">Užsakymo Pavadinimas</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ $order->name }}">
            </div>
            @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="body" class="col-md-4 col-form-label">Užsakymo Aprašymas</label>
                <div class="input-group">
                    <textarea id="body" name="body" type="text" class="form-control" aria-label="With textarea">{{ $order->body }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="client" class="col-md-4 col-form-label">Klientas</label>
                <select id="client" type="text" class="form-control" name="client">
                    @foreach ($users->where('type', 'Client') as $user)
                        <option value="{{ $user->id }}"
                        @if ($order->user->where('type', 'Client')->count() > 0)
                            @if ($order->user->where('type', 'Client')->first()->id == $user->id)
                                selected='selected'
                            @endif
                        @endif
                        @can('viewAny', Order::class)
                            disabled
                        @endcan>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="manager" class="col-md-4 col-form-label">Manageris</label>
                <select id="manager" type="text" class="form-control" name="manager">
                    @foreach ($users->where('type', 'Manager') as $user)
                        <option value="{{ $user->id }}"
                        @if ($order->user->where('type', 'Manager')->count() > 0)
                            @if ($order->user->where('type', 'Manager')->first()->id == $user->id)
                                selected='selected'
                            @endif
                        @endif
                        @cannot('update', $order)
                            disabled
                        @endcannot
                            >{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="status" class="col-md-4 col-form-label">Būsena</label>
                <select id="status" type="text" class="form-control" name="status">
                    @if($order->user->where('type', 'Manager')->count() == 0)<option value="AwaitingManager"@if($order->status == "AwaitingManager") selected='selected'@endif>Laukiama Vadybinko</option>@endif
                    <option value="ReadyForPickup"@if($order->status == "ReadyForPickup") selected='selected'@endif>Paruošta atsiėmimui</option>
                    <option value="OnHold"@if($order->status == "OnHold") selected='selected'@endif>Sustabdyta</option>
                    <option value="InProgress"@if($order->status == "InProgress") selected='selected'@endif>Tvarkoma</option>
                    <option value="Delivered"@if($order->status == "Delivered") selected='selected'@endif>Išduota Klientui</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="Estimated" class="col-md-4 col-form-label">Numatyta data</label>
                <input type="date" name="Estimated" id="Estimated" class="form-control" value="{{$order->Estimated }}">
            </div>
        </div>
        <div class="col-8 offset-2 pt-4">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
