<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable =['trans_type', 'pay_type', 'head_type', 'amount', 'trans_date', 'notes', 'document', 'page', 'status','createdby'];
}
