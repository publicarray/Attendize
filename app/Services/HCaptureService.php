<?php
namespace App\Services;

use Illuminate\Http\Request;

class HCaptureService
{
    /**
     * @var string
     */
    public $hcapture;

    /**
     * @var string
     */
    public $ip;

    /**
     * HCapture constructor
     * @param $request
     */

    public function __construct(Request $request) {
        $this->hcapture = $request->get('h-captcha-response');
        $this->ip = $request->ip();
    }

    /**
     * Determine if request was submitted by a human
     *
     * @return bool
     */
    public function isHuman() {
        if (config('attendize.hcaptcha_secret_key')) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://hcaptcha.com/siteverify', [
                'form_params' => [
                    'secret' => config('attendize.hcaptcha_secret_key'),
                    'response' => $this->hcapture,
                    // 'remoteip' => $request->ip()
                ]
            ]);
            if ($response->getStatusCode() == 200) {
                $responseData = json_decode($response->getBody());
                \Log::debug([$this->ip, $response->getBody()]);
                return $responseData->success;
            }
        }
        return false;
    }
}
