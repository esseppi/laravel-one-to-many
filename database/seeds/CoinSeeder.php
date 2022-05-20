<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Coin;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            $name = $faker->lastName();
            Coin::create([
                'name'          => $name,
                'thumb'         => $faker->imageUrl(640, 480, 'animals', true),
                'description'   => $faker->sentence(rand(0, 10)),
                'price'         => $faker->numberBetween(0, 10000),
                'amount'        => $faker->numberBetween(0, 1000),
                'slug'          => Coin::generateSlug($name)
            ]);
        }
    }
}
