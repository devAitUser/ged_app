<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;


class Dossier extends Model
{
    use HasFactory;

    public function attibuts_dossier()
    {
        return $this->hasMany('App\Models\Attributs_dossier');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    
    


    

    
}
