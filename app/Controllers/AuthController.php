<?php

namespace App\Controllers;

use App\Models\BookingsModel;
use App\Models\PaymentModel;
use App\Models\ReviewModel;
use App\Models\RidesModel;
use App\Models\UserModel;
use App\Models\VehicleModel;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class AuthController extends BaseController
{
    public function signIn()
    {
        return view('pages/signin');
    }

    public function signUp()
    {
        return view('pages/signup');
    }

    public function profile()
    {
        $userId = session()->get('user_id');
        if (!session()->has('user_id')) {
            return redirect()->to('auth/signin')->with('error', 'Access denied. Please log in.');
        }

        $vehicleModel = new VehicleModel();
        $vehicle = $vehicleModel->where('user_id', $userId)->first();
        
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $bookingModel = new BookingsModel();
        $bookings = $bookingModel->where('passenger_id', $userId)->orderBy('ride_id', 'DESC')->findAll();

        $rideHistory = [];

        foreach ($bookings as $booking) {
            $rideId = $booking['ride_id'];

            $rideModel = new RidesModel();
            $ride = $rideModel->find($rideId);

            $paymentModel = new PaymentModel();
            $payment = $paymentModel->where('ride_id', $rideId)->first();

            $reviewModel = new ReviewModel();
            $review = $reviewModel->where('ride_id', $rideId)->first();

            $rideHistory[] = [
                'ride' => $ride,
                'payment' => $payment,
                'review' => $review,
                'booking_id' => $booking['id']
            ];
        }
        return view('pages/profile', ['user' => $user, 'vehicle' => $vehicle, 'rideHistory' => $rideHistory]);
    }

    public function register()
    {
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $nic = $this->request->getPost('nic');

        if (!empty($email) && $userModel->where('email', $email)->first()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Email exists! Please try again.']);
        }

        if (!empty($phone) && $userModel->where('phone', $phone)->first()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Phone number exists! Please try again.']);
        }

        if (!empty($nic) && $userModel->where('nic', $nic)->first()) {
            return $this->response->setJSON(['success' => false, 'message' => 'NIC exists! Please try again.']);
        }

        $password = $this->generateRandomPassword();

        $userData = [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'nic' => $this->request->getPost('nic'),
            'is_driver' => $this->request->getPost('is_driver'),
            'username' => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mdimuthusw@gmail.com';
            $mail->Password = 'dwulosrdowtwxzxp';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('mdimuthusw@gmail.com', 'City Taxi');
            $mail->addAddress($userData['email'], $userData['name']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Registration Successful';
            $mail->Body = 'Thank you for registering with us. Your username is: ' . $userData['email'] . ' and your password is: ' . $password;
            $mail->AltBody = 'Thank you for registering with us. Your username is: ' . $userData['email'] . ' and your password is: ' . $password;

            if ($mail->send()) {
                $userModel = new UserModel();
                $userModel->insert($userData);
                $response = ['success' => true];
            } else {
                $response = ['success' => false];
            }
            return $this->response->setJSON($response);
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function generateRandomPassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }

        if (!isset($user['password']) || empty($user['password'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Password not set']);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid email or password']);
        }

        $role = ($user['is_driver'] == 1) ? 'driver' : 'passenger';

        // Set user session
        $session = session();
        $session->set('user_id', $user['id']);
        $session->set('email', $user['email']);
        $session->set('name', $user['name']);
        $session->set('role', $role);

        return $this->response->setJSON(['success' => true, 'message' => 'Login successful']);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return $this->response->setJSON(['success' => true, 'message' => 'Login successful']);
    }

    public function update_profile()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();

        $userData = [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'nic' => $this->request->getPost('nic'),
            'username' => $this->request->getPost('uname'),
        ];

        $password = $this->request->getVar('password');
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userData['password'] = $hashedPassword;
        }

        $userModel->update($userId, $userData);

        return $this->response->setJSON(['success' => true]);
    }

    public function register_vehicle()
    {
        $vehicleModel = new VehicleModel();
        $userId = session()->get('user_id');
        $licensePlate = $this->request->getPost('license_plate');

        $existingVehicle = $vehicleModel->where('license_plate', $licensePlate)->first();

        if ($existingVehicle) {
            return $this->response->setJSON(['success' => false, 'message' => 'License plate already exists in the database.']);
        }

        $vehicleData = [
            'user_id' => $userId,
            'vehicle_model' => $this->request->getPost('vehicle_model'),
            'vehicle_year' => $this->request->getPost('vehicle_year'),
            'license_plate' => $this->request->getPost('license_plate'),
            'vehicle_color' => $this->request->getPost('vehicle_color'),
            'insurance_company' => $this->request->getPost('insurance_company'),
            'policy_number' => $this->request->getPost('policy_number'),
            'expiration_date' => $this->request->getPost('expiration_date'),
        ];

        if ($vehicleModel->insert($vehicleData)) {
            $validationResult['success'] = true;
            return $this->response->setJSON($validationResult);
        }
    }

    public function update_vehicle()
    {
        $vehicleModel = new VehicleModel();
        $licensePlate = $this->request->getPost('license_plate');

        $existingVehicle = $vehicleModel->where('license_plate', $licensePlate)->first();

        if (!$existingVehicle) {
            return $this->response->setJSON(['success' => false, 'message' => 'Vehicle not found.']);
        }
        $vehicleId = $existingVehicle['id'];

        $updateData = [
            'vehicle_model' => $this->request->getPost('vehicle_model'),
            'vehicle_year' => $this->request->getPost('vehicle_year'),
            'vehicle_color' => $this->request->getPost('vehicle_color'),
            'insurance_company' => $this->request->getPost('insurance_company'),
            'policy_number' => $this->request->getPost('policy_number'),
            'expiration_date' => $this->request->getPost('expiration_date'),
        ];

        if ($vehicleModel->update($vehicleId, $updateData)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Vehicle data updated successfully.']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to update vehicle data.']);
        }
    }
}
