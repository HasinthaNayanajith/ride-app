<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingsModel extends Model
{
    protected $table = 'bookings'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['id', 'ride_id', 'passenger_id', 'driver_id', 'vehicle_id', 'status', 'started_at', 'completed_at']; 
}

