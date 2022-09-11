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

        // DB::table('users')->insert(array(
        //     'identifiant' => 'indexeur_jamal',
        //     'email' => 'mehdi@gmail.com',
        //     'nom' => 'jamal',
        //     'prenom' => 'kamal',
        //     'telephone' => '0697712113',
        //     'password' =>  Hash::make('123'),
        //     'created_at' => date('Y-m-d H:m:s'),
        //     'updated_at' => date('Y-m-d H:m:s'),
        // ));

        // DB::table('roles')->insert(
        //     array(
        //     'name' => 'admin',
        //     'guard_name' => 'web',
        //     'created_at' => date('Y-m-d H:m:s'),
        //     'updated_at' => date('Y-m-d H:m:s'),
        //     ),
        //     array(
        //         'name' => 'indexeur',
        //         'guard_name' => 'web',
        //         'created_at' => date('Y-m-d H:m:s'),
        //         'updated_at' => date('Y-m-d H:m:s'),
        //     ),
        //     array(
        //         'name' => 'archiviste',
        //         'guard_name' => 'web',
        //         'created_at' => date('Y-m-d H:m:s'),
        //         'updated_at' => date('Y-m-d H:m:s'),
        //     ),
        //  );
        //  DB::table('permissions')->insert(
        //     array(
        //     'name' => 'gestion des boites',
        //     'guard_name' => 'web',
        //     'created_at' => date('Y-m-d H:m:s'),
        //     'updated_at' => date('Y-m-d H:m:s'),
        //     ),
        //     array(
        //         'name' => 'Créer les dossiers',
        //         'guard_name' => 'web',
        //         'created_at' => date('Y-m-d H:m:s'),
        //         'updated_at' => date('Y-m-d H:m:s'),
        //     ),
        //     array(
        //         'name' => 'Plan de classement',
        //         'guard_name' => 'web',
        //         'created_at' => date('Y-m-d H:m:s'),
        //         'updated_at' => date('Y-m-d H:m:s'),
        //     )
        //     ,
        //     array(
        //         'name' => 'gestion des utilisateurs',
        //         'guard_name' => 'web',
        //         'created_at' => date('Y-m-d H:m:s'),
        //         'updated_at' => date('Y-m-d H:m:s'),
        //     ),
        //     array(
        //         'name' => 'Modifier les dossiers',
        //         'guard_name' => 'web',
        //         'created_at' => date('Y-m-d H:m:s'),
        //         'updated_at' => date('Y-m-d H:m:s'),
        //     ),
        //  );
        //  DB::table('role_has_permissions')->insert(
        //     array(
        //     'permission_id ' => 1,
        //     'role_id ' => 1,
        //     ),
        //     array(
        //         'permission_id ' => 1,
        //         'role_id ' => 2,
        //         ),
        //     array(
        //             'permission_id ' => 1,
        //             'role_id ' => 3,
        //     ),
        //     array(
        //         'permission_id ' => 2,
        //         'role_id ' => 1,
        //     ),
        //     array(
        //         'permission_id ' => 'gestion des boites',
        //         'role_id ' => 'web',
        //      ),
        //     array(
        //         'permission_id ' => 'gestion des boites',
        //         'role_id ' => 'web',
        //     ),
        //  );
      
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
