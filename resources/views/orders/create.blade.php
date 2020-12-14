@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/order" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Užsakymo Pavadinimas</label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="form-group row">
                        <label for="desc" class="col-md-4 col-form-label">Užsakymo Aprašymas</label>
                        <div class="input-group">
                            <textarea id="body" name="body" type="text" class="form-control" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="form-group row">
                        <label for="user_id" class="col-md-4 col-form-label">Klientas</label>
                        <select name="user_id" id="user_id" class="form-control" name="user-id">
                            @foreach ($users as $item)
                                @if ($item->type == "Client")
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <input class="form-control" id="status" name="status" type="hidden" value="AwaitingManager">
            <div class="row pt-4">
                <button type="submit" class="btn btn-primary">Sukurti užsakymą</button>
            </div>
        </form>
    </div>
@endsection
