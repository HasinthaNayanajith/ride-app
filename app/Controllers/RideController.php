<?php

namespace App\Controllers;

use Exception;

class RideController extends BaseController
{
    public function index()
    {
        $data['logged_in'] = session()->get('user_id') ? true : false;
        return view('pages/new_ride', $data);
    }
    public function available()
    {
        // get data from get request
        $pickup_location = $this->request->getGet('pl');
        $drop_location = $this->request->getGet('dl');
        $pickup_latitude = $this->request->getGet('plt');
        $pickup_longitude = $this->request->getGet('plg');
        $drop_latitude = $this->request->getGet('dlt');
        $drop_longitude = $this->request->getGet('dlg');
        $distance = $this->request->getGet('dist');
        $price = $this->request->getGet('prc');

        $userModel = new \App\Models\UserModel();
        // $data['drivers'] = $userModel->where('is_driver', 1)->where('is_available', 1)->findAll(); joining with vehicles table where userModel.id = vehicleModel.user_id
        $data['drivers'] = $userModel->select('users.*, vehicles.id as vehicle_id, vehicles.vehicle_model, vehicles.vehicle_color, vehicles.license_plate, vehicles.insurance_company')->join('vehicles', 'users.id = vehicles.user_id')->where('is_driver', 1)->where('is_available', 1)->findAll();

        $data['pickup_location'] = $pickup_location;
        $data['drop_location'] = $drop_location;
        $data['pickup_latitude'] = $pickup_latitude;
        $data['pickup_longitude'] = $pickup_longitude;
        $data['drop_latitude'] = $drop_latitude;
        $data['drop_longitude'] = $drop_longitude;
        $data['distance'] = $distance;
        $data['price'] = $price;
        return view('pages/available_rides', $data);
    }

    public function bookRide()
    {
        try {
            $passenger_id = session()->get('user_id');
            // if session is not set, return error
            if (!$passenger_id) {
                return $this->response->setJSON(['success' => false, 'message' => 'You are not logged in. Please login to continue.']);
            }
            $pickup_location = $this->request->getVar('pickup_location');
            $drop_location = $this->request->getVar('drop_location');
            $pickup_latitude = $this->request->getVar('pickup_latitude');
            $pickup_longitude = $this->request->getVar('pickup_longitude');
            $drop_latitude = $this->request->getVar('drop_latitude');
            $drop_longitude = $this->request->getVar('drop_longitude');
            $distance = $this->request->getVar('distance');
            $price = $this->request->getVar('price');

            $ridesModel = new \App\Models\RidesModel();
            $rideId = $ridesModel->insert([
                'pickup_location' => $pickup_location,
                'dropoff_location' => $drop_location,
                'pickup_lat' => $pickup_latitude,
                'pickup_long' => $pickup_longitude,
                'dropoff_lat' => $drop_latitude,
                'dropoff_long' => $drop_longitude,
                'distance' => $distance,
                'price' => $price
            ], true);

            $bookingsModel = new \App\Models\BookingsModel();
            $bookingId = $bookingsModel->insert([
                'ride_id' => $rideId,
                'driver_id' => $this->request->getVar('driver_id'),
                'passenger_id' => $passenger_id,
                'vehicle_id' => $this->request->getVar('vehicle_id'),
                'status' => 0,
                'started_at' => date('Y-m-d H:i:s'),
            ], true);

            return $this->response->setJSON(['success' => true, 'message' => 'Ride booked successfully!', 'booking_id' => $bookingId]);
        } catch (Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function viewRide(){

        $booking_id = $this->request->getGet('bookingId');
        $passenger_id = session()->get('user_id');
        $bookingModel = new \App\Models\BookingsModel();
        $rideModel = new \App\Models\RidesModel();
        $userModel = new \App\Models\UserModel();
        $vehicleModel = new \App\Models\VehicleModel();

        $booking = $bookingModel->find($booking_id);

        if(!$booking || $booking['passenger_id'] != $passenger_id){
            return redirect()->to('ride');
        }

        $ride = $rideModel->find($booking['ride_id']);
        $driver = $userModel->find($booking['driver_id']);
        $vehicle = $vehicleModel->find($booking['vehicle_id']);

        $data['booking'] = $booking;
        $data['ride'] = $ride;
        $data['driver'] = $driver;
        $data['vehicle'] = $vehicle;

        return view('pages/view_ride', $data);
    
    }
}

// AIzaSyDNrvvXy9-Bosm7r0PkzIECdkxJCB74s38
