<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiOrderTrait
{

  public function getToken()
  {
    $url = "https://www.skybuybd.com/api/v1/login";
    $formData = [
      'email' => 'admin@admin.com',
      'password' => 'OhiShahil@@@###'
    ];

    $token = session('token', []);
    if (!$token) {
      $response = $this->curlRequest($url, $formData);
      $token_data = json_decode($response);
      $token =  $token_data->data->token;
      session(['token' => $token]);
    }

    return $token;
  }

  public function orderList()
  {
    $get_token = $this->getToken();
    $bear_token = 'Authorization: Bearer ' . $get_token;
    // dd($bear_token);
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://www.skybuybd.com/api/v1/admin/order-list',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array($bear_token),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
  }


  public function curlRequest($url, $body)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $body,
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
  }

  public function get_array_value()
  {
    if (!function_exists('get_array_value')) {
      function get_array_value($array, $key, $default = null)
      {
        if (is_array($array)) {
          return  array_key_exists($key, $array) ? $array[$key] : $default;
        }
        return $default;
      }
    }
  }
}
