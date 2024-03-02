<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['id', 'name', 'address', 'email', 'phone', 'nic', 'password', 'is_driver', 'username', 'passowrd', 'is_available']; 

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first(); 
    }
}

