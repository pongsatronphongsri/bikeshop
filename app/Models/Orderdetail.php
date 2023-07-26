<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'orderdetail';

    public function order(){
        return $this->belongsTo(order::class,'order_id','id');
    }
    public function products(){
        return $this->belongsTo(product::class,'id_product','id');
    }
}
