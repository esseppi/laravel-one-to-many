<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;



use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $fillable = [
        "id",
        "name",
        "price_usd",
        "image",
        "slug",
    ];

    // GENERATORE SLUGGER
    static public function generateSlug($generatorString)
    {
        $baseSlug = Str::of($generatorString)->slug('-')->__toString();
        $slug = $baseSlug;
        $_i = 1;
        while (self::where('slug', $slug)->first()) {
            $slug = "$baseSlug-$_i";
            $_i++;
        }
        return $slug;
    }
    public function getCoins(Request $request)
    {
        $Coinlist = Http::get('https://api.coingecko.com/api/v3/coins')->json();
        // foreach ($Coinlist as $coin) {
        //     dd($coin);
        // }


        // dd($Coinlist);

        return view('admin.coins.price', ['coins' => $Coinlist]);
    }
    public function tradeCoin()
    {
        return $this->hasMany('App\Trade', 'coin_id');
    }
}
