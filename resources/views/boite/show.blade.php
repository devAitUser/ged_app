@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Information du boite') }}</div>

                <div class="card-body ml-5" >


                        <div class="row mb-3">
                            <label for="name" class="">Numéro du boite : {{$boite->num_boite}} </label>


                        </div>
                        <div class="row mb-3">
                            <label for="name" class="">Code Topographie: {{$boite->code_topographe}}</label>
                        </div>

                        <a href="{{ route('boites.index') }}" style="text-decoration: underline;float: right;"> <h6>Retour</h6></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
