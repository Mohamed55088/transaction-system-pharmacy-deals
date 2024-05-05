<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = ['type_medicine_id', 'price', 'name', 'user_id'];


    public function type()
    {
        return $this->belongsTo(type_medicine::class, 'type_medicine_id');
    }
    public function super()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sale()
    {
        return $this->hasMany(Sales::class);
    }
}
