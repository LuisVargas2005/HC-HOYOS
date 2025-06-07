<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'category',
        'model',
        'problem',
        'date',
        'time',
        'name',
        'email',
        'phone',
    ];
}
