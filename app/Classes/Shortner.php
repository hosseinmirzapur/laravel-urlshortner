<?php

namespace App\Classes;

use Illuminate\Support\Str;

class Shortner
{
    /**
     * @return string
     *
     * A 4-5 letter random string
     */
    public static function abbr(): string
    {
        return Str::random(mt_rand(4,5));
    }
}
