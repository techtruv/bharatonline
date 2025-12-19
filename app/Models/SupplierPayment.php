<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'advanceType', 'paymentDate', 'text', 'trip_id', 'user_id', 'page','bulk_type', 'ledger_amount'];

}
