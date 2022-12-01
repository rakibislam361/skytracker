<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ApiOrderTrait
{

  public function getToken()
  {
    $url = "http://192.168.0.7:3000/api/v1/login";
    $formData = [
      'email' => 'admin@admin.com',
      'password' => 'secret'
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
      CURLOPT_URL => 'http://192.168.0.7:3000/api/v1/admin/order-list',
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

  public function order_update()
  {
    $get_token = $this->getToken();
    $bear_token = 'Authorization: Bearer ' . $get_token;

    $url = "http://192.168.0.7:3000/api/v1/order-update";
    $data = [
      'order_item_number' => request('order_item_number', null),
      'order_item_rmb' => request('order_item_rmb', null),
      'product_bd_received_coast' => request('product_bd_received_coast', null),
      'purchase_rmb' => request('purchase_rmb', null),
      'chinaLocalDelivery' => request('chinaLocalDelivery', null),
      'shipping_from' => request('shipping_from', null),
      'shipping_mark' => request('shipping_mark', null),
      'chn_warehouse_qty' => request('chn_warehouse_qty', null),
      'chn_warehouse_weight' => request('chn_warehouse_weight', null),
      'cbm' => request('cmd', null),
      'carton_id' => request('carton_id', null),
      'tracking_number' => request('tracking_number', null),
      'shipped_by' => request('shipped_by', null),
      'status' => request('status', null),
    ];

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://192.168.0.7:3000/api/v1/admin/order-update',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array($bear_token),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    // dd($response);
    return $response;
  }
}
