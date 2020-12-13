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
                <input id="body" type="text" class="form-control" name="body" value="{{ $order->body }}">
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="client" class="col-md-4 col-form-label">Klientas</label>
                <select id="client" type="text" class="form-control" name="client">
                    @foreach ($users->where('type', 'Client') as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="manager" class="col-md-4 col-form-label">Manageris</label>
                <select id="manager" type="text" class="form-control" name="manager">
                    @foreach ($users->where('type', 'Manager') as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-8 offset-2 pt-4">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
