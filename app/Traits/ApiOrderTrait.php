<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiOrderTrait
{

  public function getToken()
  {
    $url = config('credential.url') . "/login";
    $token = session('token', []);

    if (!$token) {
      $response = $this->curlRequest($url);
      $token_data = json_decode($response);
      $token =  $token_data->data->token;
      session(['token' => $token]);
    }
    $bear_token = 'Authorization: Bearer ' . $token;
    return $bear_token;
  }


  public function orderList()
  {
    $get_token = $this->getToken();
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => config('credential.url') . '/admin/order-list',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array($get_token),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }


  public function curlRequest($url)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => config('credential.url') . '/login',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('email' => 'admin@admin.com', 'password' => 'secret'),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
  }

  public function order_update($data)
  {
    $get_token = $this->getToken();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => config('credential.url') . '/admin/order-update',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array($get_token),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }
}
