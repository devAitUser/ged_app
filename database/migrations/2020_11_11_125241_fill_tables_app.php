<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class FillTablesApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('users')->insert(array(
            'identifiant' => 'indexeur_jamal',
            'email' => 'mehdi@gmail.com',
            'nom' => 'jamal',
            'prenom' => 'kamal',
            'telephone' => '0697712113',
            'password' =>  Hash::make('123'),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ));
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('menus')->where('nom','=','product')->delete();
        DB::table('menus')->where('nom','=','client')->delete();
        DB::table('menus')->where('nom','=','users')->delete();
        DB::table('users')->where('email','=','mehdi@gmail.com')->delete();
        DB::table('users')->where('user_id','=','1')->delete();
        
    }
}
