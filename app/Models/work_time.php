<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work_time extends Model
{
    use HasFactory;
    protected $fillable = [
        'waiter_id',
        'end_time',
        'end_day',
        'hours_worked',
    ];
}
