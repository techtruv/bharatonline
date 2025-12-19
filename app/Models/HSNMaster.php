<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HSNMaster extends Model
{
    use HasFactory;

    protected $table = 'hsn_masters';
    protected $fillable = ['hsn_code', 'type', 'commodity', 'sgst_percent', 'cgst_percent', 'igst_percent'];

    /**
     * Get total GST percentage (SGST + CGST)
     */
    public function getTotalGSTAttribute()
    {
        return $this->sgst_percent + $this->cgst_percent;
    }

    /**
     * Get formatted GST display
     */
    public function getGstDisplayAttribute()
    {
        return $this->sgst_percent . '% + ' . $this->cgst_percent . '% = ' . $this->getTotalGSTAttribute() . '%';
    }
}
