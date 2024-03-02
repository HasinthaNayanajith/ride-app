<?php

namespace App\Controllers;

class ReviewController extends BaseController
{
    public function index()
    {
        $booking_id = $this->request->getGet('bookingId');
        // if booking id is not set, return error
        if (!$booking_id || !session()->get('user_id')) {
            return redirect()->to(base_url());
        }
        $data['booking_id'] = $booking_id;
        return view('pages/review', $data);
    }
}
