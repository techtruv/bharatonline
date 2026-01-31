<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LedgerMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ledger_masters';

    protected $fillable = [
        // Basic Information
        'type',
        'name',
        'short_name',
        'under_group_id',
        
        // Financial Information
        'opening_balance',
        'dr_cr',
        'balance_type',
        
        // Status
        'status',
        'remarks',
        
        // Corporate Address Tab
        'address_line_1',
        'state',
        'telephone',
        'email',
        'whatsapp',
        'contact_person_name',
        'mobile',
        'contact_person_designation',
        'contact_person_mobile_2',
        
        // GST Details
        'gst_number',
        'gst_registration_type',
        
        // Other Details Tab
        'pan_no',
        'aadhar_no',
        'service_tax_no',
        'credit_days',
        'credit_limit',
        'credit_bills',
        'follow_up',
        'collection_day',
        'category',
        'bill_desc_percent',
        
        // Personal Details Tab (Banking)
        'bank_name',
        'bank_branch',
        'ifsc_code',
        'account_no',
        'bank_address',
        'dob',
        'dom',
        
        // Tracking
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
        'gst_registration_date' => 'date',
        'is_gst_verified' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the account group that this ledger belongs to
     */
    public function group()
    {
        return $this->belongsTo(AccountGroup::class, 'under_group_id', 'id');
    }

    /**
     * Get the user who created this ledger
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the user who last updated this ledger
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Scope to get only active ledgers
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    /**
     * Scope to get ledgers by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get full address as string
     */
    public function getFullAddressAttribute()
    {
        $parts = [
            $this->address_line_1,
            $this->address_line_2,
            $this->city,
            $this->state,
            $this->pincode,
            $this->country,
        ];

        return implode(', ', array_filter($parts));
    }

    /**
     * Format opening balance with currency symbol
     */
    public function getFormattedOpeningBalanceAttribute()
    {
        return '₹ ' . number_format($this->opening_balance, 2);
    }

    /**
     * Check if ledger is GST registered
     */
    public function isGstRegistered()
    {
        return !empty($this->gst_number) && $this->is_gst_verified;
    }
}
