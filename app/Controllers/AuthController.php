<?php

namespace App\Controllers;

use App\Models\UserModel;
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

    public function register()
    {
        $password = $this->generateRandomPassword();

        $userData = [
            'name' => $this->request->getPost('name'),
            'address' => $this->request->getPost('address'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'nic' => $this->request->getPost('nic'),
            'is_driver' => $this->request->getPost('is_driver') ? 1 : 0,
            'username' => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        $userModel = new UserModel();
        $userModel->insert($userData);

        // Load PHPMailer
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
        $password = $this->request->getPost('password');

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
        $session->set('role', $role); 

        return $this->response->setJSON(['success' => true, 'message' => 'Login successful']);
    }


    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('login');
    }
}
