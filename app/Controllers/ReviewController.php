<?php

namespace App\Controllers;

class ReviewController extends BaseController
{
    public function index(): string
    {
        return view('pages/review');
    }
}
