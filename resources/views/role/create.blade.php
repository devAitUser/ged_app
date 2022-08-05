@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header_view" style="margin-bottom: 5px">
        <div class="sub_view">
            <a class="link_organigramme" href="{{route('home')}}">
            <span class="material-icons">  home </span>  Home
            </a>
            <a class="title_profil" href="{{route('roles.index')}}">     \
            <span class=""> Roles </span> </a>
            <span class="title_profil">     \
            <span class=""> Ajouter nouveau role </span> </span>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('nom') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    </div>
                    <div class="row mb-3">
                    <div class="col-md-6">

                            <div class="row mb-3">
                            <label for="permission" class="col-md-4 col-form-label text-md-end">{{ __('Les Permissions') }}</label>
                                <div class="col-md-6">

                                    @foreach($permissions as $value)


                                    <input type="checkbox" name="permission[]"   value="{{ $value->id }}">{{ $value->name }}
                                    <br>
                                    @endforeach
                                </div>
                            </div>

                    </div>
                </div>
                <div class="container" style="margin-left:205px">
                <div class="row">
                    <button type="submit" class="btn btn-primary ml-4">
                    {{ __('Register') }}
                    </button>
                    &nbsp;
                    <button type="reset" class="btn btn-primary">
                    {{ __('Annuler') }}
                    </button>
                </div>
                </div>
                </form>
            </div>
        </div>
        </div>
</div>
@endsection
