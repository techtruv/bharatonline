<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherEntryType extends Model
{
    use HasFactory;

    protected $table = 'voucher_entry_types';
    protected $fillable = ['code', 'name'];
}
