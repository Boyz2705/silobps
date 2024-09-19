<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt',
        'app_id'
    ];

    public function appointments()
    {
        return $this->belongsTo(Appointment::class);
    }
}
