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

    /**
     * @param string $abbr
     * @return string
     *
     * Full abbreviation path
     */
    public static function builder(string $abbr): string
    {
        $appUrl = config('app.url');
        return "{$appUrl}:8000/api/urls/{$abbr}";
    }
}
