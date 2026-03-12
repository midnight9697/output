<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IEPMC extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_number',
        'property_number',
        'issued_to',
        'computer_name',
        'brand_model',
        'mac_address',
        'serial_number',
        'unit_location',
        'assigned_to',
        'monitor_brand_model',
        'printer',
        'printer_serial_number',
        'ups_serial_number',
        'monitor_serial_number',
        'date_last_maintenance',
        'date_maintenance',
        'inspected_by',
    ];
}
