<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'weight', 'hsn_code', 'unit_id'];

    /**
     * Get the unit associated with the category.
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
