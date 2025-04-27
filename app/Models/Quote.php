<?php

namespace App\Models;

use Mongodb\Laravel\Eloquent\Model;

class Quote extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'quotes'; // A separate collection for all quotes

    protected $fillable = [
        'contract_id',   // references SolarContract->_id
        'type',          // 'initial' or 'final'
        'amount',
        'details',
        'pdf_path',
        'docx_path',
        'created_by',
    ];

    public function contract()
    {
        return $this->belongsTo(SolarContract::class, 'contract_id');
    }
}
