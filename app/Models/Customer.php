<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'address', 'user_id'];

    public function super()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function totalmoney()
    {
        return $this->hasOne(TotalMoney::class);
    }
    public function money()
    {
        return $this->hasMany(HasMoney::class);
    }
    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}
