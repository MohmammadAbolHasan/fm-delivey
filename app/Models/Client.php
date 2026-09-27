<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'name',

        'type',

        'phone',

        'email',

        'address',

        'notes',

        'is_active',

    ];

    protected $casts = [

        'is_active' => 'boolean',

    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}