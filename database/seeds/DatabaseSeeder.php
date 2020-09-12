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

        $plano_contas = [
            ['descricao' => 'Bradesco', 'conta_contabil' => '116', 'empresa_id' => 1],
            ['descricao' => 'Itau', 'conta_contabil' => '2051', 'empresa_id' => 1],
            ['descricao' => 'Banrisul', 'conta_contabil' => '220', 'empresa_id' => 1],
            ['descricao' => 'Caixa', 'conta_contabil' => '2054', 'empresa_id' => 2],
            ['descricao' => 'Caixa', 'conta_contabil' => '2054', 'empresa_id' => 3],
        ];
        DB::table('plano_contas')->insert($plano_contas);

        $tipos_despesas = [
            ['descricao' => 'Agua', 'plano_conta_id' => 1, 'empresa_id' => 1],
            ['descricao' => 'Aluguel', 'plano_conta_id' => 2, 'empresa_id' => 1],
            ['descricao' => 'Honorários', 'plano_conta_id' => 3, 'empresa_id' => 1],
            ['descricao' => 'Encargos Bancarios', 'plano_conta_id' => 1, 'empresa_id' => 2],
            ['descricao' => 'Avulsos', 'plano_conta_id' => 1, 'empresa_id' => 3],
        ];
        DB::table('tipos_despesas')->insert($tipos_despesas);

        $despesa = [
            ["data_cadastro" => date('Y-m-d', strtotime('2020-08-20')), "tipo_despesa_id" => 1, "valor" => 220.50, "historico" => 'PAGTO CON. DESPESA', "empresa_id" => 1, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-08-21')), "tipo_despesa_id" => 2, "valor" => 113.50, "historico" => 'PAGTO CON. DESPESA1', "empresa_id" => 1, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-08-22')), "tipo_despesa_id" => 3, "valor" => 115.50, "historico" => 'PAGTO CON. DESPESA2', "empresa_id" => 1, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-08-23')), "tipo_despesa_id" => 1, "valor" => 23.50, "historico" => 'PAGTO CON. DESPESA3', "empresa_id" => 1, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-08-24')), "tipo_despesa_id" => 2, "valor" => 445.50, "historico" => 'PAGTO CON. DESPESA4', "empresa_id" => 1, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-08-25')), "tipo_despesa_id" => 3, "valor" => 253.50, "historico" => 'PAGTO CON. DESPESA5', "empresa_id" => 1, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-08-26')), "tipo_despesa_id" => 1, "valor" => 1000.50, "historico" => 'PAGTO CON. DESPESA6', "empresa_id" => 1, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-08-27')), "tipo_despesa_id" => 1, "valor" => 10000.50, "historico" => 'PAGTO CON. DESPESA7', "empresa_id" => 2, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-09-28')), "tipo_despesa_id" => 1, "valor" => 50.50, "historico" => 'PAGTO CON. DESPESA8', "empresa_id" => 3, ],
            ["data_cadastro" => date('Y-m-d', strtotime('2020-09-01')), "tipo_despesa_id" => 3, "valor" => 60.50, "historico" => 'PAGTO CON. DESPESA9', "empresa_id" => 1, ],

        ];
        DB::table('despesas')->insert($despesa);

    }
}
