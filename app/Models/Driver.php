<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'car',
        'plate_number',
        'is_active',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}