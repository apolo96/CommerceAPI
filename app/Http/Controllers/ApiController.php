<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;

class ApiController extends Controller
{
    use ApiResponse;

    function __construct()
    {
        $this->middleware('auth:api');
    }
}
