<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['id', 'user_id', 'ride_id', 'stars', 'comment', 'created_at']; 
}

