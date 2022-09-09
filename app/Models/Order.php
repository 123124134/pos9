<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table ='orders';


    public function orderdetail()
    {
        return $this ->hasMany('App\OrderDetail');
    }
}
