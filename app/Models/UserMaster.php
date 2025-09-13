<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserMaster extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user_master';
    
    protected $fillable = [
        'name',
        'username',
        'phone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Relationships
    public function customers()
    {
        return $this->hasMany(CustomerMaster::class, 'created_by');
    }

    public function products()
    {
        return $this->hasMany(ProductMaster::class, 'created_by');
    }

    public function purchases()
    {
        return $this->hasManyThrough(PurchaseMaster::class, CustomerMaster::class, 'created_by', 'customer_id');
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    public function isEmployee()
    {
        return $this->role === 'Employee';
    }
}
