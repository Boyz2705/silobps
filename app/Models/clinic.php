<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'img_link',
        'map_link',
        'clinic_address',
        'clinic_name'
    ];

    public function clinic()
    {
        return $this->hasMany(Appointment::class);
    }
}
