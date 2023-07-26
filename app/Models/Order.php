<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    public function orderdetail(){
        return $this->hasMany('App\Models\orderdetail');
    }
    
    public function users(){
        return $this->belongsTo(User::class,'id_user','id');
    }
}
