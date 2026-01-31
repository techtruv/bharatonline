<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneDirectory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone_no',
        'mobile_no',
        'mobile_no1',
        'mobile_no2',
        'gst_no'
    ];
}
