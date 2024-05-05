<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateSalesCustomer extends Model
{
    use HasFactory;
    protected $fillable = ['sale_id', 'user_id', 'value_update'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sale()
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }
}
