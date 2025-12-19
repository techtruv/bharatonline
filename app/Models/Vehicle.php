<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable =['vehicleNumber','vehicleType','ownership','driver_id','supplier_id','driver_name','driver_contact','model','capacity','bodylength'];

}
