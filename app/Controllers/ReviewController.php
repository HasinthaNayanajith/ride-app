<?php

namespace App\Controllers;

use App\Models\ReviewModel;

class ReviewController extends BaseController
{
    public function index()
    {
        return view('pages/review');
    }
    
    public function create()
    {
        $user_id = session()->get('user_id');
        $reviewData = [
            'user_id' => $user_id,
            'ride_id' => $this->request->getPost('ride_id'),
            'stars' => $this->request->getPost('stars'),
            'comment' => $this->request->getPost('comment'),
        ];

        $reviewModel = new ReviewModel();

        if ($reviewModel->insert($reviewData)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Review submitted successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to submit review.']);
        }
    }
}
