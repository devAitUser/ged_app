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
        $organigramme = Organigramme::take(1)->first();
         $dossiers = $organigramme->dossiers;
         $Count = $dossiers->count();

   
        $data = array( 'Count' => $Count );

        return view('home' ,  $data );
    }
    public function folder()
    {
        return view('folder.index');
    }
}
