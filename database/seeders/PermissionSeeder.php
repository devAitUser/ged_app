<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::create(['name' => 'gestion des boites']);
        Permission::create(['name' => 'Créer les dossiers']);
        Permission::create(['name' => 'Créer les boites']);
        Permission::create(['name' => 'Plan de classement']);
        Permission::create(['name' => 'gestion des utilisateurs']);
    }
}
