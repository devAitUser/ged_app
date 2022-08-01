@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Information of Role') }}</div>

                <div class="card-body">


                        <div class="row mb-3">
                            <label for="name" class="">Nom : {{$role->name}} </label>

                        </div>

                        <div class="row mb-3">
                            <form action="">
                            <label for="name" class="">Permission: </label>

                            <button class="btn btn-success">Update</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
