<?php

namespace App\Controllers;

class CallCenterController extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id') || session()->get('user_id') != 1){
            return redirect()->to(base_url('auth/signin'));
        }
        $data['logged_in'] = true;
        // get available drivers
        $userModel = new \App\Models\UserModel();
        $data['drivers'] = $userModel->select('users.*, vehicles.id as vehicle_id, vehicles.vehicle_model, vehicles.vehicle_color, vehicles.license_plate, vehicles.insurance_company')->join('vehicles', 'users.id = vehicles.user_id')->where('is_driver', 1)->where('is_available', 1)->findAll();

        // get all rides joining with bookings table where rides.id = bookings.ride_id
        $bookingModel = new \App\Models\BookingsModel();
        $data['rides'] = $bookingModel->select('rides.*, bookings.id as booking_id, bookings.passenger_id, bookings.driver_id, bookings.status, bookings.started_at')->join('rides', 'rides.id = bookings.ride_id')->where('bookings.is_call_center', 1)->findAll();
        // foreach ride, get passenger and driver details
        $userModel = new \App\Models\UserModel();
        foreach ($data['rides'] as $key => $ride) {
            $data['rides'][$key]['passenger'] = $userModel->find($ride['passenger_id']);
            $data['rides'][$key]['driver'] = $userModel->find($ride['driver_id']);
        }

        // var_dump($data['rides']);
        // die();
        return view('pages/call_center', $data);
    }
}
