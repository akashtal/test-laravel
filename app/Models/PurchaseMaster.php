<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseMaster extends Model
{
    protected $table = 'purchase_master';
    
    protected $fillable = [
        'customer_id',
        'product_id',
        'invoice_no',
        'purchase_date',
        'value',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'value' => 'decimal:2',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(CustomerMaster::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductMaster::class, 'product_id');
    }
}
