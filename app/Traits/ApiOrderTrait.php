<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiOrderTrait
{

  public function getToken()
  {
    $url = config('api.url') . "/login";
    $token = session('token', []);

    if (!$token) {
      $response = $this->curlRequest($url);
      $token = $response->data->token;
      session(['token' => $token]);
    }

    return $token;
  }


  public function orderList($filter)
  {
    $url = config('api.url') . '/admin/order-item-list';
    $get_token = $this->getToken();
    $response = Http::withToken($get_token)->get($url, $filter);
    return $response->object();
  }

  public function curlRequest($url)
  {
    $response = Http::post($url, [
      'email' => config('api.email'),
      'password' => config('api.password'),
    ]);
    return $response->object();
  }

  public function order_update($data)
  {
    $get_token = $this->getToken();
    $url = config('api.url') . '/admin/order-item-update';
    $response = Http::withToken($get_token)->post($url, $data);
    return $response->object();
  }

  public function recentorderList($filter)
  {
    $url = config('api.url') . '/admin/recent-order';
    $get_token = $this->getToken();
    $response = Http::withToken($get_token)->get($url, $filter);
    return $response->object();
  }

  public function singleOrder($id)
  {
    $url = config('api.url') . '/admin/order-show/' . $id;
    $get_token = $this->getToken();
    $response = Http::withToken($get_token)->get($url, $id);
    return $response->object();
  }


  public function orderStatusUpdate($data)
  {
    $get_token = $this->getToken();
    $url = config('api.url') . '/admin/order-status-update';
    $response = Http::withToken($get_token)->post($url, $data);
    return $response->object();
  }

  public function OrderItem($id)
  {
    $url = config('api.url') . '/admin/order-item-details/' . $id;
    $get_token = $this->getToken();
    $response = Http::withToken($get_token)->get($url, $id);
    return $response->object();
  }


  public function updateCouponTrait($data)
  {
    $get_token = $this->getToken();
    $url = config('api.url') . '/admin/order/coupon-update';
    $response = Http::withToken($get_token)->post($url, $data);
    return $response->object();
  }

  public function depositCouponTrait($data)
  {
    $get_token = $this->getToken();
    $url = config('api.url') . '/admin/order/deposit-update';
    $response = Http::withToken($get_token)->post($url, $data);
    return $response->object();
  }
}
