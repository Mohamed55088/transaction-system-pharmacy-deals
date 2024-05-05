<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasMoney extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['value', 'type_medicine_id', 'customer_id', 'month', 'user_id'];

    public function typeMedicine()
    {
        return $this->belongsTo(type_medicine::class, 'type_medicine_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function userUpdate()
    {
        return $this->hasMany(UpdateValueCustomer::class);
    }
}
