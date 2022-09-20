<?php

namespace App\Http\Controllers;
use Smalot\PdfParser\Parser;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organigramme;
use App\Models\User;
use App\Models\Dossier;
use App\Models\File_searche;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Routing\UrlGenerator;

use Spatie\PdfToText\Pdf;







class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        $this->middleware('auth');
        $this->url = $url;
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
        $count_dossier_indexé=0;

        $ckeck_select = false;

        $nom_projet='';

        if($user->projet_select_id != NULL) {


            $projet_select_id = $user->projet_select_id;

            $organigramme = Organigramme::find($projet_select_id);
            $dossiers = $organigramme->dossiers;
            $nom_projet = $organigramme->nom;
            $Count = $dossiers->count();

            $ckeck_select = true;


            $date_current = date('m/d/Y h:i:s a', time());


            $parse_date_current = Carbon::parse($date_current);

            $convert_date_current = $parse_date_current->format('Y-m-d');

            $dossier_indexe = Dossier::where([
                'organigramme_id' =>  $organigramme->id ,
                'user_id' =>  $user->id,
           
                ])->get();


                for($i=0;$i<count($dossier_indexe);$i++){
                    $createdAt = Carbon::parse($dossiers[$i]->created_at);
                    $date_create_dossier = $createdAt->format('Y-m-d');
                    if($date_create_dossier ==  $convert_date_current ){
                        $count_dossier_indexé++;
                    }
                    

                }

            
          

        }
       
        $data = array( 'Count' => $Count , 'ckeck_select' => $ckeck_select , 'nom_projet' => $nom_projet , 'dossier_indexe' => $count_dossier_indexé );

        return view('home' ,  $data );
    }
    public function folder()
    {
        return view('folder.index');
    }
}
