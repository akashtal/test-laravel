<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerMaster extends Model
{
    protected $table = 'customer_master';
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'created_by',
        'is_deleted',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(UserMaster::class, 'created_by');
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseMaster::class, 'customer_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_deleted', false);
    }
}
