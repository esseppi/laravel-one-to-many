<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Coin extends Model
{
    public $timestamps = null;
    protected $fillable = [
        "name",
        "description",
        "thumb",
        "slug",
        "price",
        "amount"
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
}
