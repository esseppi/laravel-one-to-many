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
    public function run(Faker $faker, Coin $coin)
    {
        for ($i = 0; $i < 60; $i++) {

            $coinTicker = Coin::inRandomOrder()->first()->slug;
            $userName = User::inRandomOrder()->first()->slug;
            $coin1 = Coin::inRandomOrder()->first()->id;
            $coin2 = Coin::inRandomOrder()->first()->id;
            if ($coin1 == $coin2) {
                $coin2 = Coin::inRandomOrder()->first()->id;
            }
            if ($coin2 == $coin1) {
                $coin2 = Coin::inRandomOrder()->first()->id;
            }
            if ($coin2 == $coin1) {
                $coin2 = Coin::inRandomOrder()->first()->id;
            }

            $tradeSlug = $coinTicker . $userName;
            Trade::create([
                'user_id'        => User::inRandomOrder()->first()->id,
                'baseCoin_id'    => $coin1,
                'foreignCoin_id' => $coin2,
                'date'           => $faker->dateTimeInInterval('-2 year', '+3 days'),
                'basePrice'      => $faker->numberBetween(0, 10000),
                'foreignPrice'   => $faker->numberBetween(0, 10000),
                'baseAmount'     => $faker->numberBetween(0, 1000),
                'foreignAmount'  => $faker->numberBetween(0, 1000),
                'tradeDir'       => $faker->boolean(),
                'slug'           => Trade::generateSlug($tradeSlug),
                'comments'       => $faker->sentence(rand(0, 10)),
            ]);
        }
    }
}
