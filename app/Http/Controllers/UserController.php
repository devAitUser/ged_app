<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    

    public function index()
    {

        $user = Auth::user();
        $data = array(
            'user' => $user
        );
        return view('user.index', $data);

    }

    public function update(Request $request)
    {
        $user_current = Auth::user();
        $user = User::find($user_current->id);

        $user->telephone = $request->telephone;
        if($request->mot_de_pass != '' ){
            $user->password = $request->mot_de_pass;
        }
        $user->email = $request->email;
        
         $user->save();

         return redirect()->route('user_profile');

    }


}