<?php

namespace App\Controllers;

use App\Models\ReviewModel;

class ReviewController extends BaseController
{
    public function index()
    {
        $booking_id = $this->request->getGet('ride');
        // if booking id is not set, return error
        if (!$booking_id || !session()->get('user_id')) {
            return redirect()->to(base_url());
        }
        $data['booking_id'] = $booking_id;
        return view('pages/review', $data);
    }
    
    public function create()
    {
        $user_id = session()->get('user_id');
        $reviewData = [
            'id' => $user_id,
            'ride_id' => $this->request->getPost('ride_id'),
            'stars' => $this->request->getPost('stars'),
            'comment' => $this->request->getPost('comment'),
        ];

        $reviewModel = new ReviewModel();
        // if review already exists, return error
        if ($reviewModel->where('id', $user_id)->where('ride_id', $reviewData['ride_id'])->first()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Review already submitted.']);
        }

        if ($reviewModel->insert($reviewData)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Review submitted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to submit review.']);
        }
    }
}
