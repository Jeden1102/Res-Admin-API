<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'sum_price',
        'waiter_id',
        'notes',
        'table_id',
        'products',
    ];
}
