<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CSRFTokenController extends Controller
{
    public function getToken()
    {
        \Session::start();
        return response()->json(['csrf_token' => csrf_token()]);
    }
}
