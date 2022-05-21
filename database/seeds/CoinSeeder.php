<?php

use App\Coin;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Http;



class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // CREAZIONE COIN SINGOLA
        // $Coinlist = Http::get('https://api.coingecko.com/api/v3/coins/bitcoin')->json();
        // Coin::create([
        //     "price_usd"   => $Coinlist['market_data']['current_price']['usd'],
        //     "name"        => $Coinlist['name'],
        //     "image"       => $Coinlist['image']['thumb'],
        // ]);

        // CREAZIONE MULTIPLA COIN
        // $Coinlist = Http::get('https://api.coingecko.com/api/v3/simple/supported_vs_currencies')->json();
        // for ($i = 0; $i < 10; $i++) {
        //     Coin::create([
        //         "price_usd"   => $Coinlist['market_data']['current_price']['usd'],
        //         "name"        => $Coinlist['name'],
        //         "image"       => $Coinlist['image']['thumb'],
        //     ]);
        // };

        $link = 'https://api.coingecko.com/api/v3/coins/';
        $total = Http::get($link)->json();

        for ($i = 0; $i < count($total); $i++) {
            $coin = $total[$i];
            Coin::create([
                "price_usd"   => $coin['market_data']['current_price']['usd'],
                "name"        => $coin['name'],
                "image"       => $coin['image']['large'],
            ]);
        };


        // SELEZIONA LE COINS INIZIAL SPECIFICANDO IL NOME NELL'ARRAY initialCoins
        // $initialCoins = ['bitcoin', 'ethereum', 'polkadot',];
        // for ($i = 0; $i < count($initialCoins); $i++) {
        //     $word = $initialCoins[$i];
        //     $Coinlist = Http::get($link . $word)->json();
        //     Coin::create([
        //         "price_usd"   => $Coinlist['market_data']['current_price']['usd'],
        //         "name"        => $Coinlist['name'],
        //         "image"       => $Coinlist['image']['large'],
        //     ]);
        // }
    }
}
