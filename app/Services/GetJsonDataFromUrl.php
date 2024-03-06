<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GetJsonDataFromUrl {
    public function handle(string $endpoint) {
        $response = Http::get($endpoint);

        if($response->failed()) {
            abort(500);
        }

        return $response->json();
    }
}
