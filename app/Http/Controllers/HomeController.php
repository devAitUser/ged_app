<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organigramme;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $Count = 0;

        $ckeck_select = false;

        $nom_projet='';

        if($user->projet_select_id != NULL) {


            $projet_select_id = $user->projet_select_id;

            $organigramme = Organigramme::find($projet_select_id);
            $dossiers = $organigramme->dossiers;
            $nom_projet = $organigramme->nom;
            $Count = $dossiers->count();

            $ckeck_select = true;
          

        }
       
        $data = array( 'Count' => $Count , 'ckeck_select' => $ckeck_select , 'nom_projet' => $nom_projet );

        return view('home' ,  $data );
    }
    public function folder()
    {
        return view('folder.index');
    }
}
