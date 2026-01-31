<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;

    protected $table = 'account_groups';
    protected $fillable = ['code', 'group_name', 'under_group_id'];

    /**
     * Get the parent group (under_group relationship)
     */
    public function parentGroup()
    {
        return $this->belongsTo(AccountGroup::class, 'under_group_id');
    }

    /**
     * Get child groups (subgroups)
     */
    public function childGroups()
    {
        return $this->hasMany(AccountGroup::class, 'under_group_id');
    }
}
