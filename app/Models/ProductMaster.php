<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMaster extends Model
{
    protected $table = 'product_master';
    
    protected $fillable = [
        'name',
        'remarks',
        'created_by',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(UserMaster::class, 'created_by');
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseMaster::class, 'product_id');
    }
}
