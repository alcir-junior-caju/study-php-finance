<?php

use Phinx\Seed\AbstractSeed;
use Faker\Provider\Base;
use Caju\Finance\Models\CategoryCost;

class BillPaysSeeder extends AbstractSeed
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    private $categories;
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
        require_once __DIR__ . '/../bootstrap.php';
        $this->categories = CategoryCost::all();
        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider($this);
        $billPays = $this->table('bill_pays');

        foreach (range(1, 10) as $value) {
            $userId = 1; //rand(1, 4);
            $data[] = [
                'date_launch'      => $faker->dateTimeBetween('-1 month')->format('Y-m-d'),
                'name'             => $faker->word,
                'value'            => $faker->randomFloat(2, 10, 1000),
                'user_id'          => $userId,
                'category_cost_id' => $faker->categoryId($userId),
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s')
            ];
        }

        $billPays->insert($data)->save();
    }

    public function categoryId($userId)
    {
        $categories = $this->categories->where('user_id', $userId);
        $categories = $categories->pluck('id');
        return Base::randomElement($categories->toArray());
    }
}
