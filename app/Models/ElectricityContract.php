<?php
// app/Models/ElectricityContract.php

namespace App\Models;

use Mongodb\Laravel\Eloquent\Model;

class ElectricityContract extends Model
{
    protected $connection = 'mongodb'; // Important for MongoDB

    protected $collection = 'electricity_contracts'; // Specific MongoDB collection name

    protected $fillable = [
        'contract_id',                   // Unique identifier for the contract
        'customer_name',
        'customer_address',
        'contact_number',
        'customer_email',                // Email of the customer
        'installation_type',
        'installation_date',
        'contract_start_date',           // Explicit contract start
        'contract_end_date',             // Explicit contract end
        'contract_duration',             // In months or years
        'tariff_plan',                   // Tariff plan name or ID
        'meter_number',                  // Electricity meter number
        'initial_reading',               // Initial meter reading
        'contract_amount',               // Total amount for the contract
        'payment_terms',                 // Payment frequency, methods, etc.
        'payment_status',                // Paid, Pending, Overdue, etc.
        'last_payment_date',             // Last payment done
        'next_billing_date',              // Next billing schedule
        'service_location_coordinates',  // Latitude/Longitude or similar
        'power_capacity_kw',              // Contracted power in kilowatts
        'voltage_level',                  // Supply voltage level
        'supply_type',                    // Single-phase or Three-phase
        'billing_cycle',                  // Monthly, Quarterly, etc.
        'terms_and_conditions',           // Contract terms (text or URL)
        'notes',                          // Additional notes
        'assigned_to',                    // New: assigned user/employee ID or name
        'created_by',                     // User ID or name (for audit)
        'updated_by',                     // Last updated user
    ];

    protected $casts = [
        'installation_date' => 'datetime',
        'contract_start_date' => 'datetime',
        'contract_end_date' => 'datetime',
        'last_payment_date' => 'datetime',
        'next_billing_date' => 'datetime',
        'service_location_coordinates' => 'array',
    ];
}
