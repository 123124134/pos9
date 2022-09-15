<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ='products';



    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
