@extends('layouts.app')
@section('content')

<div class="container">

    <form style="width: 50%;margin:0 auto;padding-bottom:155px" action="{{ route('boites.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <h1 style="text-decoration: underline;font-size:xx-large;text-align:center">Ajouter une boîte</h1>
          <label >Numéro du boîte :<span style="color: red">*</span></label>
          <input type="number" min="1" class="form-control" name="num_boite" placeholder="Entrez le numéro du boite">
        </div>
        <div class="form-group">
            <label>Code topographie :</span></label>
            <input type="text" class="form-control" name="code_topographe" placeholder="Entrez le code topographie">
          </div>
        <div class="form-group">
          <label>Objet :</span></label>
          <textarea name="objet" id="" cols="66" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label>Premier date de consultation :</span></label>
            <input type="date" class="form-control" name="premier_date" placeholder="Password">
          </div>
          <div class="form-group">
            <label>Dernier date de consultation :</span></label>
            <input type="date" class="form-control" name="dernier_date" placeholder="Password">
          </div>
          <div class="form-group">
            <label>Remarque :</label>
            <textarea name="remarque" id="" cols="66" rows="3"></textarea>
          </div>

        <button type="submit" class="btn btn-primary" >Ajouter</button>
      </form>
</div>


@endsection
