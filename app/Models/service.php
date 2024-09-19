<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'services_name',
        'img_link',
        'srv_routes',
        'price'
    ];
    public function services()
    {
        return $this->hasMany(Appointment::class);
    }
}
