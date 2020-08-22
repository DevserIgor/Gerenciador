<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $empresas = [
            ['nro_empresa' => 100, 'nome' => 'Empresa 1', 'cnpj' => '64.896.609/0001-73'],
            ['nro_empresa' => 200, 'nome' => 'Empresa 2', 'cnpj' => '24.818.779/0001-15'],
            ['nro_empresa' => 300, 'nome' => 'Empresa 3', 'cnpj' => '82.639.422/0001-76'],
        ];
        DB::table('empresas')->insert($empresas);

        $password = Hash::make('654321');
        $users = [
            ['name' => 'Master', 'empresa_id'=> null, 'email' => 'masterUser@aprocont.com', 'tipo' => 'admin', 'password' => "$password"],
            ['name' => 'Fucionario Um', 'empresa_id'=> null, 'email' => 'fun1@aprocont.com', 'tipo' => 'fun ','password' => "$password"],
            ['name' => 'User1', 'empresa_id'=> 1, 'email' => 'user1@aprocont.com', 'tipo' => 'user', 'password' => "$password"],
            ['name' => 'User2', 'empresa_id'=> 2, 'email' => 'user2@aprocont.com', 'tipo' => 'user', 'password' => "$password"],
            ['name' => 'User3', 'empresa_id'=> 3, 'email' => 'user3@aprocont.com', 'tipo' => 'user', 'password' => "$password"],
        ];
        DB::table('users')->insert($users);
    }
}
