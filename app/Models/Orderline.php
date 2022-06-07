<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    use HasFactory;
    protected $table = "orderlines";

    protected $fillable = [
        'orderid',
        'productid',
        'quantity'
    ];
    public $timestamps = false;
}
