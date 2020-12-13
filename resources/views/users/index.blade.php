@extends('layouts.app')

@section('content')
    <This class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <label for="name" class="col-md-4 col-form-label">Vartotojo vardas</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ $user->personaldetails->name }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="surname" class="col-md-4 col-form-label">Vartotojo pavardė</label>
                <input id="surname" type="text" class="form-control" name="surname" value="{{ $user->personaldetails->surname }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="address" class="col-md-4 col-form-label">Vartotojo adresas</label>
                <input id="address" type="text" class="form-control" name="address" value="{{ $user->personaldetails->address }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="PhoneNumber" class="col-md-4 col-form-label">Varototjo tel. numeris</label>
                <input id="PhoneNumber" type="text" class="form-control" name="PhoneNumber" value="{{ $user->personaldetails->PhoneNumber }}" disabled>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="type" class="col-md-4 col-form-label">Varototjo tipas</label>

                <select id="type" type="type" class="form-control" name="type" disabled>
                    <option value="Admin"@if($user->type == "Admin") selected='selected'@endif>Admin</option>
                    <option value="Manager"@if($user->type == "Manager") selected='selected'@endif>Manager</option>
                    <option value="Client"@if($user->type == "Client") selected='selected'@endif>Client</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <label for="Modified" class="col-md-4 col-form-label">Paskutini kartą modifikuota</label>
                <input id="Modified" type="datetime" class="form-control" name="PhoneNumber" value="{{ $user->updated_at }}" disabled>
            </div>
        </div>
        @can('update', $user)
        <div class="col-8 offset-2 pt-4">
            <a role="button" class="btn btn-info btn-lg btn-block"  href="/user/{{ $user->id }}/edit">Edit this user</a>
        </div>
        @endcan
    </div>
@endsection

