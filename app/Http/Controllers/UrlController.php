<?php

namespace App\Http\Controllers;

use App\Http\Services\UrlService;

class UrlController extends Controller
{
    public function __construct(private readonly UrlService $service) {}

    public function show($url)
    {
        $urlWithInfo = $this->service->findUrl($url);

        return response()->json([
            'url' => $urlWithInfo
        ]);
    }
}
