<?php

namespace App\Controllers;

class RideController extends BaseController
{
    public function index(): string
    {
        return view('pages/new_ride');
    }
    public function available(): string
    {
        return view('pages/available_rides');
    }
}