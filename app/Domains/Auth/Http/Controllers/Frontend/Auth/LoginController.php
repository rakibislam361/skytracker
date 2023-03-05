<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Events\User\UserLoggedIn;
use App\Rules\Captcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\Hash;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class LoginController.
 */
class LoginController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route(home_route());
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ['required', 'max:255', 'string'],
            'password' => array_merge(['max:100'], PasswordRules::login()),
            'g-recaptcha-response' => ['required_if:captcha_status,true', new Captcha],
        ], [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ]);
    }

    /**
     * Overidden for 2FA
     * https://github.com/DarkGhostHunter/Laraguard#protecting-the-login.
     *
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        try {
            return $this->guard()->attempt(
                $this->credentials($request),
                $request->filled('remember')
            );
        } catch (HttpResponseException $exception) {
            $this->incrementLoginAttempts($request);

            throw $exception;
        }
    }

    /**
     * The user has been authenticated.
     *
     * @param  Request  $request
     * @param $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (!$user->isActive()) {
            auth()->logout();

            return redirect()->route('frontend.index')->withFlashDanger(__('Your account has been deactivated.'));
        }

        event(new UserLoggedIn($user));

        if (config('boilerplate.access.user.single_login')) {
            auth()->logoutOtherDevices($request->password);
        }
    }

    public function loginOtp()
    {
        $phone = request('phone');

        if (!$phone) {
            return response(['message' => 'Mobile number not valid', 'status' => false]);
        }

        $msg = [];
        $otp_number = rand(1000, 9999);
        $name = "ausbd_user";
        $email = $phone . "@ausbd360.com";
        $address = $email . "_" . $email . "_" . $phone;
        $password = Hash::make($phone);

        $user = User::where('phone', $phone)->first();
        if (!$user) {
            $insert_id = GroCustomer::insertGetId([
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'password' => $password,
                'customer_type' => 'b2b',
                'del_status' => 'Live'
            ]);
            if ($insert_id) {
                $user = User::create([
                    'name' => $name,
                    'phone' => $phone,
                    'otp_code' => $otp_number,
                    'email' => $email,
                    'address' => $address,
                    'password' => md5($password),
                    'linked_id' => $insert_id,
                    'email_verified_at' => now(),
                ]);
            }
        } else {
            $user->update(['otp_code' => $otp_number]);
        }

        $sms = singleSms($phone, "Your OTP code is {$otp_number}", '111');
        $sms_status = getArrayKeyData($sms, 'status');
        return response(['message' => 'OTP code Send you phone', 'status' => true, 'phone' => $phone, 'sms_status' => $sms_status]);
    }

    public function otpSubmit(Request $request)
    {
        $phone = request('phone');
        $otp_code = request('otp');
        $user = User::where('phone', $phone)->where('otp_code', $otp_code)->first();

        if ($user) {
            linked_customer_with_user($user);
            updateUserBadge($user);
            // spatie permission for customer role and approved
            $user->givePermissionTo('approved-customer');
            if (!$user->hasRole('Customerb2b') && !$user->hasRole('Administrator')) {
                $user->assignRole('Customerb2b');
            }
            Auth::loginUsingId($user->id, true);
            $msg = ['message' => 'Logged in successfully', 'code' => '200'];
            return response(json_encode($msg));
        }
        return response(json_encode(['message' => 'Invalid request!', 'code' => '302']));
    }
}
