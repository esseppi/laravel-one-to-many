<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Trade;
use App\User;
use App\Coin;

class TradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            $coinTicker = Coin::inRandomOrder()->first()->ticker;
            $userName = User::inRandomOrder()->first()->name;


            $tradeSlug = $coinTicker . '-' . $userName;
            Trade::create([
                'user_id'       => User::inRandomOrder()->first()->id,
                'coin_id'       => Coin::inRandomOrder()->first()->id,
                'price'         => $faker->numberBetween(0, 10000),
                'amount'        => $faker->numberBetween(0, 1000),
                'tradeDir'      => $faker->boolean(),
                'slug'          => Trade::generateSlug($tradeSlug),
                'comments'      => $faker->sentence(rand(0, 10)),
            ]);
        }
    }
}
