<?php

namespace App\Models;

use CodeIgniter\Model;

class RidesModel extends Model
{
    protected $table = 'rides'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['id', 'pickup_location', 'dropoff_location', 'pickup_lat', 'pickup_long', 'dropoff_lat', 'dropoff_long', 'distance', 'price']; 
}

