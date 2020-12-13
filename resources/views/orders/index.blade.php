@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <label for="name" class="col-md-4 col-form-label">Užsakymo Pavadinimas</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ $order->name }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="body" class="col-md-4 col-form-label">Užsakymo Aprašymas</label>
                <input id="body" type="text" class="form-control" name="body" value="{{ $order->body }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="client" class="col-md-4 col-form-label">Klientas</label>
                <input id="client" type="text" class="form-control" name="client" value="{{ $order->user->where('type', 'Client')->first()->name }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="manager" class="col-md-4 col-form-label">Manageris</label>
                <input id="manager" type="text" class="form-control" name="manager" value="@if(!empty($manager)){{ $manager->name}}@endif" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="status" class="col-md-4 col-form-label">Būsena</label>
                <select id="status" type="text" class="form-control" name="status" disabled>
                    <option value="AwaitingManager"@if($order->status == "AwaitingManager") selected='selected'@endif>Laukiama Vadybinko</option>
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
                <input type="date" name="EStimated" id="EStimated" class="form-control" value={{$order->Estimated }} disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="Modified" class="col-md-4 col-form-label">Paskutini kartą modifikuota</label>
                <input id="Modified" type="datetime" class="form-control" name="Modified" value="{{ $order->updated_at }}" disabled>
            </div>
        </div>
        @can('update', $order)
        <div class="col-8 offset-2 pt-4">
            <a role="button" class="btn btn-info btn-lg btn-block"  href="/order/{{ $order->id }}/edit">Edit this user</a>
        </div>
        @endcan
    </div>
@endsection
