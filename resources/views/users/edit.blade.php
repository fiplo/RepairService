@extends('layouts.app')

@section('content')
<This class="container">
    <div class="col-12 text-center">
        <h2>Vartotojo redagavimas</h2></div>
    </div>
    <form action="/user/{{$user->id}}" method="POST">
        @method('PATCH')
        @csrf
        <div class="form-group row">
            <div class="col-8 offset-2">
                <label for="name" class="col-md-4 col-form-label">Vartotojo vardas</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?? $user->personaldetails->name }}" autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class=" form-group row">
            <div class="col-8 offset-2">
                <label for="surname" class="col-md-4 col-form-label">Vartotojo pavardė</label>
                <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') ?? $user->personaldetails->surname }}" >
                @error('lastsurname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-8 offset-2">
                <label for="address" class="col-md-4 col-form-label">Vartotojo adresas</label>
                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') ?? $user->personaldetails->address }}" >
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-8 offset-2">
                <label for="PhoneNumber" class="col-md-4 col-form-label">Varototjo tel. numeris</label>
                <input id="PhoneNumber" type="text" class="form-control" name="PhoneNumber" value="{{ old('PhoneNumber') ?? $user->personaldetails->PhoneNumber }}" >
                @error('PhoneNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-8 offset-2">
                <label for="type" class="col-md-4 col-form-label">Varototjo tipas</label>
                <select id="type" type="type" class="form-control" name="type">
                    <option value="Admin"@if($user->type == "Admin") selected='selected'@endif>Admin</option>
                    <option value="Manager"@if($user->type == "Manager") selected='selected'@endif>Manager</option>
                    <option value="Client"@if($user->type == "Client") selected='selected'@endif>Client</option>
                </select>
                @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row col-8 offset-2 pt-4">
            <button type="submit" class="btn btn-primary">Išsaugoti</button>
        </div>
    </form>
    <div class="form-group row">
        <div class="col-8 offset-2">
            <label class="col-md-4 col-form-label">Paskutini kartą modifikuota</label>
            <input type="datetime" class="form-control" value="{{ $user->updated_at }}" disabled>
        </div>
    </div>

</div>
@endsection
