<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organigramme extends Model
{
    use HasFactory;
 

    public function dossier_champ()
    {
        return $this->hasMany('App\Models\Dossier_champ','organigramme_id');
    }


    public function dossiers()
    {
        return $this->hasMany('App\Models\Dossier','organigramme_id');
    }

  

}
