@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier la permissions') }}</div>

                <div class="card-body">
                    <form  action="{{ route('permissions.update',$permission->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('nom') is-invalid @enderror" name="name" value="{{$permission->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="container" style="margin-left:205px">
                            <div class="row">
                                <button type="submit" class="btn btn-primary ml-4">
                                    {{ __('Register') }}
                                </button>
                                &nbsp;

                                <button type="reset" class="btn btn-primary" >
                                    {{ __('Annuler') }}
                                </button>
                            </div>
                          <a href="{{ route('permissions.index') }}" style="text-decoration: underline;text-align: center"> <h6>retour</h6></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
