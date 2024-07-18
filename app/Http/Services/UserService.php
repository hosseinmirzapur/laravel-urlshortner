<?php

namespace App\Http\Services;

use App\Classes\Shortner;
use App\Models\Url;
use Illuminate\Support\Facades\Redis;

class UserService
{
    public function shorten(string $link): string
    {
        $abbr = Shortner::abbr();
        $user = request()->user();

        $url = Url::query()
            ->where('actual_url', $link)
            ->where('user_id', $user->id)
            ->first();

        if ($url) {
            // return an empty string in case there was recurring urls
            return "";
        }

        $url = $user->urls()->create([
            'actual_url' => $link,
            'short_url' => $abbr,
        ]);

        Redis::command('zadd', ['abbr', 0, $abbr]);
        return $abbr;
    }

    public function clicks($limit)
    {
        // zrevrange command can return sorted lists based on their score and sorted in descending way
        if ($limit != null) {
            $result = Redis::command('zrevrange', ['abbr', 0, $limit - 1]);
        } else {
            $result = Redis::command('zrevrange', ['abbr', 0, -1]);
        }

        return $result;
    }


    public function userUrls()
    {
        $user = request()->user();
        $createdUrlsByUser = $user->urls;
        $allUserUrlsInfo = [];

        foreach ($createdUrlsByUser as $url) {
            $allUserUrlsInfo[] = [
                'actual_url' => $url->actual_url,
                'short_url' => $url->short_url,
                'created_at' => $url->created_at,
                'username' => $user->username,
                'clicked' => Redis::command('zscore', ['abbr', $url->short_url])
            ];
        }

        return $allUserUrlsInfo;
    }
}
