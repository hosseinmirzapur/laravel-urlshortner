<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

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
            'abbreviation' => config('app.url') . '/' . $abbr,
        ]);
    }

    public function clicks()
    {

    }

    public function urls()
    {

    }

    public function search()
    {

    }
}
