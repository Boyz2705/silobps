<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'pet_name',
        'phone',
    ];
    public function pets()
    {
        return $this->hasMany(Appointment::class);
    }
}
