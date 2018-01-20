<?php

namespace App\Http\Controllers\Transaction;

use App\Transaction;
use App\Http\Controllers\ApiController;

class TransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->showAll(Transaction::all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Transaction $transaction)
    {
        return $this->showOne($transaction);
    }

}
