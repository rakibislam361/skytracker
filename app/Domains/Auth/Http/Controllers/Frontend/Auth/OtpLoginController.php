<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class LoginController.
 */
class OtpLoginController extends Controller
{
  use AuthenticatesUsers;


  public function loginWithOtp()
  {
    $phone = request('phone');
    $user = User::where('phone', $phone)->first();
    $otp = mt_rand(1000, 9999);

    $status = false;

    if ($user) {
      if (!$user->email) {
        $user->email = $phone . '@otpLogin.com';
      }
      $user->otp_code = $otp;
      $user->save();
      if ($user->otp_code) {
        $status = true;
      }
    } else {
      $user = new User();
      $user->timezone = 'Asia/Dhaka';
      $user->confirmed = 1;
      $user->active = 1;
      $user->phone = $phone;
      $user->email = $phone . '@otpLogin.com';
      $user->otp_code = $otp;
      $user->save();
      if ($user->otp_code) {
        $status = true;
      }
    }


    $appUrl = env('APP_URL', 'c2b.com.bd');
    if (get_setting('sms_active_otp_message')) {
      $txt = get_setting('sms_otp_message');
      $txt = str_replace('[otp]', $otp, $txt);
      $txt = str_replace('[appUrl]', $appUrl, $txt);
    } else {
      $txt = "Your {$appUrl} One Time Password(OTP) is {$otp} Validity for OTP is 3 minutes. Helpline 01871778844";
    }

    $response = '';

    if ($user && $phone) {
      $response = send_ware_SMS($txt, $phone);
    }

    $user_id = $user->id ?? null;

    return response()->json([
      'status' => $status,
      'response' => $response,
      'phone' => $phone,
      'user_id' => $user_id
    ]);
  }


  public function OtpCodeVerify()
  {

    $otp_code = request('otp_code');
    $userPhone = request('userPhone');
    $userId = request('userId');
    $status = false;
    $user = User::where('phone', $userPhone)
      ->where('otp_code', $otp_code)
      ->whereNotNull('active')
      ->first();

    if ($user) {
      $status = true;
      Auth::login($user, true);
      return response(['status' => $status, 'user' => $user]);
    }

    return response(['status' => $status]);
  }
}
