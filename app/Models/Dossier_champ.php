<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier_champ extends Model
{
    use HasFactory;
    public function organigramme(){

        return $this->hasMany('App\Models\Organigramme');
        
        
      } 
}
