<?php

namespace App\Http\Services;

use App\Classes\Shortner;
use Illuminate\Support\Facades\Redis;

class UserService
{
    public function shorten(string $link): string
    {
        $abbr = Shortner::abbr();
        $username = request()->user()->username;

        // a set of links is used so there is a connection between usernames and urls
        $result = Redis::command('sadd', [$username, $link]);

        // sorted set used so a score is incremented each time by click
        // checking for result value so no recurring link is counted
        if ($result == 1) {
            Redis::command('zadd', [$abbr, 0, $link]);
            return $abbr;
        }
        // return an empty string in case there was recurring urls
        return "";
    }

    public function clicks($limit)
    {
        if ($limit != null) {
            $result = Redis::command('zrevrange', [0, $limit - 1]);
        } else {
            $result = Redis::command('zrevrange', [0, -1]);
        }

        return $result;
    }
}
