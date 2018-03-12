<?php

use App\User;
use App\Roles;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name'    =>  'Pablo Rosales',
            'email'    =>  'prosales@researchmobile.co',
            'password'    =>  bcrypt('admin'),
            'status'    =>  1,
            'role_id' => 1,
            'movil' => 0
        ]);

        User::create([
            'name'    =>  'Usuario Movil',
            'email'    =>  'movil@researchmobile.co',
            'password'    =>  bcrypt('secret'),
            'status'    =>  1,
            'role_id' => 3,
            'movil' => 1
        ]);

        Roles::create([
            'name'    =>  'Administrador'
        ]);
        Roles::create([
            'name'    =>  'Operaciones'
        ]);
        Roles::create([
            'name'    =>  'Comercial'
        ]);
        Roles::create([
            'name'    =>  'Aseguramiento'
        ]);
        Roles::create([
            'name'    =>  'Facturación'
        ]);
        Roles::create([
            'name'    =>  'Creditos y Cobros'
        ]);

        factory(App\Customers::class, 100)->create();
    }
}
