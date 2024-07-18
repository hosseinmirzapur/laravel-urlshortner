<?php

namespace App\Http\Services;

use App\Models\Url;
use Illuminate\Support\Facades\Redis;

class UrlService
{
    public function findUrl(string $url): string
    {
        $link = Url::query()
            ->where('short_url', $url)
            ->firstOrFail();

        Redis::command('zincrby', ['abbr', 1, $link->short_url]);

        return $link->actual_url;
    }
}
