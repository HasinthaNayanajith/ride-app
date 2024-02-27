<?php

namespace App\Controllers;

class PaymentController extends BaseController
{
    public function index(): string
    {
        return view('pages/payment');
    }
}
