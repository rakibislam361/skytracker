<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiAccountTrait
{
    public function getToken()
    {
        $url = config('api.url') . '/login';
        $token = session('token', []);
        if (!$token) {
            $response = $this->curlRequest($url);
            $token = $response->data->token;
            session(['token' => $token]);
        }

        return $token;
    }

    public function curlRequest($url)
    {
        $response = Http::post($url, [
            'email' => config('api.email'),
            'password' => config('api.password'),
        ]);
        return $response->object();
    }
    public function recentorderListTrait($filter)
    {
        $url = config('api.url') . '/admin/recent-order';
        $get_token = $this->getToken();
        $response = Http::withToken($get_token)->get($url, $filter);
        return $response->object();
    }

    public function skybuyTableTrait($filter)
    {

        $url = config('api.url') . '/admin/order-item-list';
        $get_token = $this->getToken();
        $response = Http::withToken($get_token)->get($url, $filter);
        return $response->object();
    }
}
