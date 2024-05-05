<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_medicine extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function type()
    {
        return $this->hasOne(type_medicine::class);
    }
}
