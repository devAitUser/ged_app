@extends('layouts.app')
@section('content')

<div class="container">

    <form style="width: 50%;margin:0 auto;padding-bottom:155px" action="{{ route('boites.update',$boite->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <h1 style="text-decoration: underline;font-size:xx-large;text-align:center">Modifier la boîte</h1>
          <label >Numéro du boîte :</span></label>
          <input type="number" min="1" class="form-control" name="num_boite" value="{{$boite->num_boite}}" placeholder="Entrez le numéro du boite">
        </div>
        <div class="form-group">
            <label>Code topographie :</span></label>
            <input type="text" class="form-control" name="code_topographe" value="{{$boite->code_topographe}}" placeholder="Entrez le code topographie">
          </div>
        <div class="form-group">
          <label>Objet :</span></label>
          <textarea name="objet"  id="" cols="66" rows="5">{{$boite->objet}}</textarea>
        </div>
        <div class="form-group">
            <label>Premier date de consultation :</span></label>
            <input type="date" class="form-control" name="premier_date" value="{{$boite->premier_date}}" placeholder="Password">
          </div>
          <div class="form-group">
            <label>Dernier date de consultation :</span></label>
            <input type="date" class="form-control" name="dernier_date" value="{{$boite->dernier_date}}" placeholder="Password">
          </div>
          <div class="form-group">
            <label>Remarque :</label>
            <textarea name="remarque" id="" cols="66" rows="3">{{$boite->remarque}}</textarea>
          </div>

        <button type="submit" class="btn btn-primary" >Modifier</button>      <a href="{{ route('boites.index') }}" style="text-decoration: underline;"> <h6>retour</h6></a>

      </form>

</div>


@endsection
