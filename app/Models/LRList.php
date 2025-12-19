<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LRList extends Model
{
    use HasFactory;
    protected $fillable = ['trip_id', 'lr_no', 'material', 'details'];
    
}
