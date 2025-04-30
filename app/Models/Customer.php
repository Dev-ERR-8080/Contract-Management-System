<?php

namespace App\Models;

use Mongodb\Laravel\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'mongodb'; // Use MongoDB connection
    protected $collection = 'customers'; // Optional if collection name is different

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'pincode',
        'aadhaar_number',
        'pan_number',
        'connection_type',
        'supply_type',
        'meter_number',
        'consumer_number',
        'installation_date',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'customer_id');
    }
}
