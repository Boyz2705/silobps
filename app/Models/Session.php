<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'time'
    ];

    public function session()
    {
        return $this->hasMany(Appointment::class);
    }
}
