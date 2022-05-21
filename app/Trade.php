<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Trade extends Model
{
    public $timestamps = null;
    protected $fillable = [
        "coin_id",
        "user_id",
        "slug",
        "price",
        "amount",
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
    public function coin()
    {
        return $this->belongsTo('App\Coin', 'coin_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'trade_id');
    }
}
