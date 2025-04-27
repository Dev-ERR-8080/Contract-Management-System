<?php

namespace App\Models;

use Mongodb\Laravel\Eloquent\Model;

class SolarContract extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'solar_contracts';

    protected $fillable = [
        'customer_name',
        'site_address',
        'product_ids',
        'total_cost',
        'installation_date',
        'status',
        'assigned_to',
        'notes',
        'progress_updates'
    ];

    protected $casts = [
        'product_ids' => 'array',
        'installation_date' => 'datetime',
        'progress_updates' => 'array',
    ];
}
