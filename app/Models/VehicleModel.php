<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table = 'vehicles';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['user_id', 'vehicle_model', 'vehicle_year', 'license_plate', 'vehicle_color', 'insurance_company', 'policy_number', 'expiration_date']; 
}

