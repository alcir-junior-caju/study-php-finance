<?php

use Phinx\Seed\AbstractSeed;
use Faker\Provider\Base;

class BillReceivesSeeder extends AbstractSeed
{
    const NAMES = [
        'Salário',
        'Freela',
        'Restituição Imposto',
        'Vendas',
        'Bolsa de Valores',
        'CDI',
        'Tesouro Direto',
        'Previdência Privada'
    ];

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider($this);
        $billReceives = $this->table('bill_receives');

        foreach (range(1, 10) as $value) {
            $data[] = [
                'date_launch'   => $faker->dateTimeBetween('-1 month')->format('Y-m-d'),
                'name'          => $faker->billReceivesName(),
                'value'         => $faker->randomFloat(2, 10, 1000),
                'user_id'       => 1, //rand(1, 4),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ];
        }

        $billReceives->insert($data)->save();
    }

    public function billReceivesName()
    {
        return Base::randomElement(self::NAMES);
    }
}
