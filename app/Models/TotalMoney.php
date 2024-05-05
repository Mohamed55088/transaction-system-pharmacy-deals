<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalMoney extends Model
{
    use HasFactory;

    protected $fillable = ['imported', 'local', 'customer_id'];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
