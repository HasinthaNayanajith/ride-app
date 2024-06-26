<?php

namespace App\Controllers;

use App\Models\PaymentModel;

class PaymentController extends BaseController
{
    public function index()
    {
        $booking_id = $this->request->getGet('bookingId');
        // if booking id is not set, return error
        if (!$booking_id || !session()->get('user_id')) {
            return redirect()->to(base_url());
        }
        $data['booking_id'] = $booking_id;
        // get booking details
        $bookingModel = new \App\Models\BookingsModel();
        $data['booking'] = $bookingModel->find($booking_id);
        // get ride details
        $rideModel = new \App\Models\RidesModel();
        $data['ride'] = $rideModel->find($data['booking']['ride_id']);
        return view('pages/payment', $data);
    }

    public function create()
    {
        $paymentData = [
            'ride_id' => $this->request->getVar('booking_id'),
            'amount' => $this->request->getVar('amount'),
            'payment_date' => date('Y-m-d H:i:s'),
        ];

        $bookingModel = new \App\Models\BookingsModel();
        // if booking status is not 0, return error
        $booking = $bookingModel->find($paymentData['ride_id']);
        if ($booking['status'] != 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Booking already paid.']);
        }
        $paymentModel = new PaymentModel();
        if ($paymentModel->insert($paymentData)) {
            // update booking status
            $bookingModel = new \App\Models\BookingsModel();
            $bookingModel->update($paymentData['ride_id'], ['status' => 1, 'completed_at' => date('Y-m-d H:i:s'), 'ride_id' => $this->request->getVar('booking_id')]);
            // get driver id
            $booking = $bookingModel->find($paymentData['ride_id']);
            // update driver availability
            $userModel = new \App\Models\UserModel();
            $userModel->update($booking['driver_id'], ['is_available' => 1]);
            return $this->response->setJSON(['success' => true, 'message' => 'Payment completed successfully.', 'ride_id' => $paymentData['ride_id']]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to create payment.']);
        }
    }
}
