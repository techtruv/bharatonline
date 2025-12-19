<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['partyName', 'vehicleNumber', 'driverName', 'supplierName', 'origin', 'destination', 'billingType', 'partyFreightAmount', 'supplierBillingType', 'truckHireAmount', 'startDate', 'startKmsReading', 'lrNo', 'materialName', 'note', 'status'];
}
