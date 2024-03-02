<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['id', 'ride_id', 'passenger_id', 'driver_id', 'amount', 'payment_date']; 
}

