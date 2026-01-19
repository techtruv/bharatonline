<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HsnMaster extends Model
{
    protected $table = 'hsn_masters';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'hsn_code',
        'type',
        'commodity',
        'sgst_percent',
        'cgst_percent',
        'igst_percent',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'sgst_percent' => 'decimal:2',
        'cgst_percent' => 'decimal:2',
        'igst_percent' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope: Get only active HSN codes
     */
    public function scopeActive($query)
    {
        return $query->get();
    }

    /**
     * Scope: Get HSN codes by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope: Search by HSN code or commodity name
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where('hsn_code', 'like', "%{$keyword}%")
                    ->orWhere('commodity', 'like', "%{$keyword}%");
    }

    /**
     * Accessor: Get total GST rate (SGST + CGST)
     */
    public function getTotalGstRateAttribute()
    {
        return (float)($this->sgst_percent + $this->cgst_percent);
    }

    /**
     * Accessor: Get total tax rate (SGST + CGST)
     */
    public function getTotalTaxRateAttribute()
    {
        return (float)($this->sgst_percent + $this->cgst_percent);
    }

    /**
     * Accessor: Get formatted tax description
     */
    public function getFormattedTaxAttribute()
    {
        return "SGST: {$this->sgst_percent}% | CGST: {$this->cgst_percent}% | IGST: {$this->igst_percent}%";
    }

    /**
     * Get tax rate by type
     */
    public function getTaxRateByType($type = 'SGST')
    {
        return match($type) {
            'SGST' => $this->sgst_percent,
            'CGST' => $this->cgst_percent,
            'IGST' => $this->igst_percent,
            'TOTAL_GST' => $this->total_gst_rate,
            default => 0,
        };
    }
}
