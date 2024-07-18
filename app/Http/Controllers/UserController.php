<?php

namespace App\Http\Controllers;

use App\Classes\Shortner;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isType;

class UserController extends Controller
{
    public function __construct(private readonly UserService $service) {}

    public function shorten(Request $request)
    {
        $data = $request->validate([
            'link' => ['required', 'url']
        ]);

        $abbr = $this->service->shorten($data['link']);
        if ($abbr == "") {
            return response()->json([
                'message' => 'you already have registered this link'
            ], 400);
        }

        return response()->json([
            'abbreviation' => Shortner::builder($abbr)
        ]);
    }

    public function clicks(Request $request)
    {
        $limit = $request->query('limit');
        if ($limit != null && !is_numeric($limit)) {
            return response()->json([
                'message' => 'limit must be a number'
            ]);
        }
        $urls = $this->service->clicks($limit);
        return response()->json([
            'urls' => $urls
        ]);
    }

    public function urls()
    {
        $user_urls = $this->service->userUrls();
        return response()->json([
            'urls' => $user_urls
        ]);
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $result = $this->service->search($q);
        return response()->json([
            'urls' => $result
        ]);
    }
}
