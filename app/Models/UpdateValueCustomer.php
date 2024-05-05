<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateValueCustomer extends Model
{
    use HasFactory;
    protected $fillable = ['value_update', 'has_money_id', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function money()
    {
        return $this->belongsTo(HasMoney::class, 'has_money_id');
    }
}
