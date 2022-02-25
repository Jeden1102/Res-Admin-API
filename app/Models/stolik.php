<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stolik extends Model
{
    use HasFactory;
    protected $fillable = [
        'xCoord',
        'yCoord',
    ];
}
