<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
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

    protected function validateLogin(Request $request)
    {
        if(setting('captcha_status') == 'on' && setting('site_key') != null){
            $customMessages = [
                'g-recaptcha-response.required' => 'Please check the captcha box.',
            ];
            $this->validate($request, [
                'g-recaptcha-response'=>'required',
                $this->username() => 'required|string',
                'password' => 'required|string',
            ],$customMessages);
        }else{
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }

    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
