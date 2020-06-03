<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use View;
use App\Services\HCaptureService;

class UserLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Shows login form.
     *
     * @param  Request  $request
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
     * @param  Request  $request
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
                ->with(['message' => trans('Controllers.fill_email_and_password'), 'failed' => true])
                ->withInput();
        }

        if (config('attendize.recaptcha_secret')) {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'https://www.recaptcha.net/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => config('attendize.recaptcha_secret'),
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

        $hcapture = new HCaptureService($request);
        if (!$hcapture->isHuman()) {
            return Redirect::back()
                ->with(['message' => trans("Controllers.incorrect_captcha"), 'failed' => true])
                ->withInput();
        }

        if (Auth::attempt(['email' => $email, 'password' => $password], true) === false) {
            return Redirect::back()
                ->with(['message' => trans('Controllers.login_password_incorrect'), 'failed' => true])
                ->withInput();
        }
        return redirect()->intended(route('showSelectOrganiser'));
    }
}
