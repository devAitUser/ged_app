@extends('layouts.app')

<style>
    .card-header {
    display: flex !important;
   }

   .panel_view_bottom {
   display: block;
   }
   .panel_view_bottom {
    height: auto !important;
  margin-bottom: 37px;
   }
   .panel_view_details {
    margin-bottom: 15px;
   }
   #organigramme_table_wrapper {
    margin-bottom: 15px;
   }
   .panel-heading {
    width: 80% !important;
   }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    
                <a href="{{ route('roles.index') }}" > <h6>Les roles </h6> </a>  
               \ {{ __('Modifier le role') }}
            
              </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('roles.update',$role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom du role :') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('nom') is-invalid @enderror" name="name" value="{{$role->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="container" style="margin-left:205px">
                         
                          
                        </div>
                    </form>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Les Permissions :') }}</label>

                        <div class="col-md-6">
                             @if ($role->permissions)
                                 @foreach ($role->permissions as $role_permission)

                                     <form class="" method="POST"
                                    action="{{ route('revokePermission', [$role->id, $role_permission->id]) }}"
                                    style="margin: 2px"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">{{ $role_permission->name }}</button>
                                </form>
                                 @endforeach
                             @endif
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                </div>
                <hr>


                <div class="card-header">{{ __('Attribuer des permissions à ce rôle') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('rolepermission',$role->id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="permission" class="col-md-4 col-form-label text-md-end">{{ __('Les Permissions') }}</label>

                            <div class="col-md-6">
                                <select class="custom-select" id="permission" name="permission">

                                    @foreach ($permissions as $permision)
                                    <option value="{{$permision->name}}">{{$permision->name}}</option>
                                    @endforeach

                                  </select>

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
                                    {{ __('Ajouter') }}
                                </button>
                                &nbsp;

                                <button type="reset" class="btn btn-primary" >
                                    {{ __('Annuler') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
