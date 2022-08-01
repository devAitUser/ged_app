@extends('layouts.auth')

@section('content')



<div class="main-content">

        <img src="{{ asset('img_app/logo_m.png') }}" class="logo_login">

        <div class="block_login">
            <form method="POST" action="{{ route('checkLogin') }}">

              @csrf

                <div class="input-container">
                    <span class="material-icons pers">
                        person
                        </span>
                    <input id="identifiant" class="input-field_login" type="text" value="{{ old('identifiant') }}" name="identifiant" required autocomplete="identifiant" autofocus >
                </div>


                <div class="input-container pass">
                    <span class="material-icons">
                        vpn_key
                        </span>
                    <input id="password" type="password" class="input-field_pass" type="password"  name="password" required autocomplete="current-password">
                </div>

                <input class="form-check-input" type="checkbox" name="remember" id="remember"  checked>

                <button type="submit"  class="btn_login">

                    <span class="material-icons">
                        login
                        </span>


                </button>

            </form>

            @if (Session::has('success'))
            <div class="alert alert-success"> {{Session::get('success')}}</div>
            @endif
           @if (Session::has('fail'))
           <div class="alert alert-danger" role="alert" style="color:red;margin-left: 163px;">
          {{Session::get('fail')}}
           </div>
           @endif



        </div>

        <img src="{{ asset('img_app/office-g.png') }}" class="img_archives">

</div>
@endsection
