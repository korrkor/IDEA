<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',             // Allow name to be mass-assigned
        'status',           // Allow status to be mass-assigned
        'registration_date' // Allow registration_date to be mass-assigned
    ];
}