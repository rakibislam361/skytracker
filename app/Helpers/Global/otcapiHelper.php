<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Contracts\HttpClient\ResponseInterface;

if (!function_exists('load_otc_api')) {
  function load_otc_api()
  {
    return new Client([
      'base_uri' => get_setting('chinabazarb2b_api_url'),
      'timeout' => 20.50
    ]);
  }
}

if (!function_exists('setOtcParams')) {
  function setOtcParams()
  {
    return [
      'api_token' => get_setting('chinabazarb2b_api_token')
    ];
  }
}

if (!function_exists('getArrayKeyData')) {
  function getArrayKeyData($array, string $key, $default = null)
  {
    if (is_array($array)) {
      return array_key_exists($key, $array) ? $array[$key] : $default;
    }
    return $default;
  }
}

if (!function_exists('SearchItemsFrame')) {
  function SearchItemsFrame($search, $type, $offset = 1, $limit = 24)
  {
    $query = setOtcParams();
    $query['type'] = $type;
    $query['search'] = $search;
    $query['framePosition'] = $offset;
    $query['frameSize'] = $limit;
    try {
      $response = load_otc_api()->request('GET', 'SearchItemsFrame', ['query' => $query]);
      $statusCode = $response->getStatusCode();
      // dd($query);
      if ($statusCode == 200) {
        $body = json_decode($response->getBody(), true);
        if (is_array($body)) {
          $Result = getArrayKeyData($body, 'Result', []);
          return getArrayKeyData($Result, 'Items', []);
        }
      }
    } catch (GuzzleHttp\Exception\ClientException $e) {
      return [];
    }
  }
}

if (!function_exists('GetItemFullInfo')) {
  function GetItemFullInfo($item_id)
  {
    $query = setOtcParams();
    $query['itemId'] = $item_id;

    $retries = 0;
    while ($retries < 10) {
      try {
        $promise = load_otc_api()->requestAsync('GET', 'GetItemFullInfo', ['query' => $query]);
        $response = $promise->wait();
        if ($response->getStatusCode() == 200) {
          $body = json_decode($response->getBody(), true);
          if (is_array($body)) {
            return array_key_exists('OtapiItemFullInfo', $body) ? $body['OtapiItemFullInfo'] : [];
          }
        }
        break;
      } catch (GuzzleHttp\Exception\RequestException $e) {
        $retries++;
        if ($retries === 5) {
          return [];
        }
      }
    }
  }
}

if (!function_exists('GetItemDescription')) {
  function GetItemDescription($item_id)
  {
    $query = setOtcParams();
    $query['itemId'] = $item_id;
    $retries = 0;
    while ($retries < 7) {
      try {
        $response = load_otc_api()->request('GET', 'GetItemDescription', ['query' => $query]);
        if ($response->getStatusCode() == 200) {
          $content = json_decode($response->getBody(), true);
          if (is_array($content)) {
            return array_key_exists('ItemDescription', $content) ? $content['ItemDescription'] : [];
          }
        }
        break;
      } catch (GuzzleHttp\Exception\RequestException $e) {
        $retries++;
        dd($e);
        if ($retries === 7) {
          return [];
        }
      }
    }
  }
}

if (!function_exists('GetVendorInfo')) {
  function GetVendorInfo($vendorId)
  {
    $query = setOtcParams();
    $query['vendorId'] = $vendorId;
    try {
      $response = load_otc_api()->request('GET', 'GetVendorInfo', ['query' => $query]);
      if ($response->getStatusCode() == 200) {
        $content = json_decode($response->getBody(), true);
        if (is_array($content)) {
          return array_key_exists('VendorInfo', $content) ? $content['VendorInfo'] : '';
        }
      }
    } catch (GuzzleHttp\Exception\ClientException $e) {
      return [];
    }
  }
}

if (!function_exists('SearchVendorItemsFrame')) {
  function SearchVendorItemsFrame($vendorId,  $offset = 0, $limit = 35)
  {
    $query = setOtcParams();
    $query['vendorId'] = $vendorId;
    $query['offset'] = $offset;
    $query['limit'] = $limit;
    try {
      $response = load_otc_api()->request('GET', 'searchVendorItemsFrame', ['query' => $query]);
      $statusCode = $response->getStatusCode();
      if ($statusCode == 200) {
        return json_decode($response->getBody(), true);
      }
    } catch (GuzzleHttp\Exception\ClientException $e) {
      return [];
    }
  }
}
