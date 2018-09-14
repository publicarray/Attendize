<?php

namespace app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiBaseController extends Controller
{
    protected $account_id;

    public function __construct()
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $this->account_id = $user->account_id;
        }
    }
}
