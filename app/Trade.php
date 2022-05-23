<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Trade extends Model
{
    public $timestamps = null;
    protected $fillable = [
        "baseCoin_id",
        "foreignCoin_id",
        "user_id",
        "date",
        "slug",
        "basePrice",
        "foreignPrice",
        "baseAmount",
        "foreignAmount",
        "tradeDir",
        "comments",
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

    // MIE FUNZIONI
    public function baseCoin()
    {
        return $this->belongsTo(Coin::class, 'baseCoin_id');
    }

    public function foreignCoin()
    {
        return $this->belongsTo(Coin::class, 'foreignCoin_id');
    }
    // public function coin()
    // {
    //     return $this->belongsTo('App\Coin', 'coin_id');
    // }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
