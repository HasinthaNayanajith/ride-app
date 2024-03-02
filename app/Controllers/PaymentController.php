<?php

namespace App\Controllers;

use App\Models\PaymentModel;

class PaymentController extends BaseController
{
    public function index(): string
    {
        return view('pages/payment');
    }

    public function create()
    {
        $passengerId = session()->get('user_id');
        $ride_id = $this->request->getPost('ride_id');
        $paymentData = [
            'ride_id' => $ride_id,
            'passenger_id' => $passengerId,
            'driver_id' => $this->request->getPost('driver_id'),
            'amount' => $this->request->getPost('amount'),
            'payment_date' => $this->request->getPost('payment_date'),
        ];

        $paymentModel = new PaymentModel();

        if ($paymentModel->insert($paymentData)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Payment created successfully.', 'ride_id' => $ride_id]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create payment.']);
        }
    }
}
