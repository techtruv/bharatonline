<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierCharges extends Model
{
    use HasFactory;
    protected $fillable = ['billType','chargesType','chargesAmount','chargesDate','notes','trip_id','user_id','page'];

}
