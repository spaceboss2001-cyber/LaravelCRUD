<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'tables_needed',
        'reservation_date',
        'reservation_time',
        'party_size',
        'status',
    ];

    protected $dates = [
        'reservation_date',
    ];
}
