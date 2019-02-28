<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Redirect;
use View;

class UserLoginController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest');
    }

    /**
     * Shows login form.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function showLogin(Request $request)
    {
        /*
         * If there's an ajax request to the login page assume the person has been
         * logged out and redirect them to the login page
         */
        if ($request->ajax()) {
            return response()->json([
                'status'      => 'success',
                'redirectUrl' => route('login'),
            ]);
        }

        return View::make('Public.LoginAndRegister.Login');
    }

    /**
     * Handles the login request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $captcha = $request->get('grecaptcha');

        if (empty($email) || empty($password)) {
            return Redirect::back()
                ->with(['message' => trans("Controllers.fill_email_and_password"), 'failed' => true])
                ->withInput();
        }

        if (env('GOOGLE_RECAPTCHA_SECRET_KEY')) {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'https://www.recaptcha.net/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => env('GOOGLE_RECAPTCHA_SECRET_KEY'),
                    'response' => $captcha,
                    // 'remoteip' => ''
                ]
            ]);
            if (!$res->getStatusCode() == 200) {
                return Redirect::back()
                    ->with(['message' => trans("Controllers.incorrect_captcha"), 'failed' => true])
                    ->withInput();
            }
            $data = json_decode($res->getBody());
            if (!$data->success || $data->action != 'login' || $data->score <= 0.6) {
                if (isset($data->score)) {
                    \Log::info($data->score);
                }
                return Redirect::back()
                    ->with(['message' => trans("Controllers.incorrect_captcha"), 'failed' => true])
                    ->withInput();
            }
            \Log::info($data->score);
        }

        if ($this->auth->attempt(['email' => $email, 'password' => $password], true) === false) {
            return Redirect::back()
                ->with(['message' => trans("Controllers.login_password_incorrect"), 'failed' => true])
                ->withInput();
        }
        return redirect()->intended(route('showSelectOrganiser'));
    }
}
