<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boite extends Model
{
    //use HasFactory;
    protected $fillable=['objet','num_boite','premier_date','dernier_date','code_topographe','remarque'];

}
