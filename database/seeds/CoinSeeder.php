<?php

use App\Coin;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 10; $i++) {
            $coins = ['BTC', 'ETH', 'DOT'];
            $numb = rand(0, 2);
            Coin::create([
                "ticker"  => $coins[$numb],
                "thumb"   => $faker->imageUrl(360, 360, 'animals', true, 'cats'),
                "slug"    => Coin::generateSlug($coins[$numb]),
            ]);
        }
    }
}
