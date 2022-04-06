<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDelivery extends Model
{
    use HasFactory;
    protected $table = 'orders_delivery';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'street',
        'number',
        'sumPrice',
        'date',
        'time',
        'deliveryPrice',
        'extra',
        'items',
    ];

}
