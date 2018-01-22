<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use App\Http\Controllers\ApiController;

class BuyerSellerController extends ApiController
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()->with('product.seller')
            ->get()->pluck('product.seller')->unique('id')->values();
        return $this->showAll($sellers);
    }

}
