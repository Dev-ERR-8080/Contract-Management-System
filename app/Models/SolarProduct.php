<?php

namespace App\Models;

use MongoDB\laravel\Eloquent\Model;

class SolarProduct extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'solar_products';

    protected $fillable = [
        'name',
        'brand',          
        'wattage',        
        'price',
        'stock',          
        'description',
        'category',
        'image_path',
    ];
}
