<?php

use Phinx\Seed\AbstractSeed;
use Faker\Provider\Base;

class CategoryCostsSeeder extends AbstractSeed
{
    const NAMES = [
        'Telefone',
        'Supermercado',
        'Água',
        'Escola',
        'Cartão',
        'Luz',
        'IPVA',
        'Imposto de Renda',
        'Gasolina',
        'Vestuário',
        'Entretenimento',
        'Reparos'
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
        $categoryCosts = $this->table('category_costs');

        foreach (range(1, 10) as $value) {
            $data[] = [
                'name'       => $faker->categoryName(),
                'user_id'    => 1, //rand(1, 4),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $categoryCosts->insert($data)->save();
    }

    public function categoryName()
    {
        return Base::randomElement(self::NAMES);
    }
}
