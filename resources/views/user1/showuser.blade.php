@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}</div>

                <div class="card-body">


                        <div class="row mb-3" style="position: relative">
                         <a href="{{ route('edit') }}">  <button class="btn btn-success" style="position: absolute;right:0;">Modifier</button></a>
                            <label for="name" class="">Nom : {{$user->nom}} </label>


                        </div>
                        <div class="row mb-3">
                            <label for="name" class="">Email: {{$user->email}}</label>
                        </div>


                </div>
                <div class="card-header">{{ __('Modifier le role') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Role Occupé :') }}</label>


                        <div class="col-md-6">
                            @if ($user->roles)
                                @foreach ($user->roles as $user_role)

                                    <form class="" method="POST"
                                   action="{{ route('removeRole', [$user->id, $user_role->id]) }}"
                                   style="margin: 2px"
                                   onsubmit="return confirm('Are you sure?');">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="btn btn-danger">{{ $user_role->name }}</button>
                               </form>
                                @endforeach
                            @endif

                       </div>
                    </div>
                    <form method="POST" action="{{ route('assignRole',$user->id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Les Roles') }}</label>

                            <div class="col-md-6">
                                <select class="custom-select" id="role" name="role">
                                    <option selected disabled>------------------------------------</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>

                                    @endforeach
                                  </select>


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

                <div class="card-header">{{ __('Modifier les permissions') }}</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="permission" class="col-md-4 col-form-label text-md-end">{{ __('Permission assigné :') }}</label>

                        <div class="col-md-6">
                            @if ($user->permissions)
                                @foreach ($user->permissions as $user_permission)

                                    <form class="" method="POST"
                                   action="{{ route('revokePermission', [$user->id, $user_permission->id]) }}"

                                   style="margin: 2px"
                                   onsubmit="return confirm('Are you sure?');">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="btn btn-danger">{{ $user_permission->name }}</button>
                               </form>
                                @endforeach
                            @endif

                       </div>
                    </div>
                    <form method="POST" action="{{ route('givePermission', $user->id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="permission" class="col-md-4 col-form-label text-md-end">{{ __('Les permissions') }}</label>

                            <div class="col-md-6">
                                <select class="custom-select" id="permission" name="permission">
                                    <option selected disabled>------------------------------------</option>
                                    @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>

                                    @endforeach
                                  </select>


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
                    <br>
                    @if (Session::has('message'))
                    <div class="alert alert-success" style="width: 100%"> {{Session::get('message')}}</div>
                    @endif
                   @if (Session::has('err'))
                   <div class="alert alert-danger" style="width: 100%" role="alert" style="color:red;margin-left: 163px;">
                  {{Session::get('err')}}
                   </div>
                   @endif


                </div>
                <a href="{{ route('user_list') }}" style="text-decoration: underline;float:right;color: black"> <h6>Retour</h6></a>

            </div>

        </div>
    </div>
</div>

@endsection

