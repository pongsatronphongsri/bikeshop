<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orderdetail;
use App\Models\order;
use Illuminate\Support\Facades\Auth;

class OrderDetailController extends Controller
{
    //
    public function index(){
        
        $order = order::all();
        
        return view('/orderdetail/index',compact('order'));
    }

    public function finish_order($id) {
        $order = order::find($id);
        $order->status = 1;
        $order->save();
        $orderdetail = orderdetail::where("order_id",$order->id)->get();
        foreach ($orderdetail as $i) {
            $i->status = 1;
            $i->save();
        }
        return redirect('admin/orderdetail');
    }

    public function status($id) {
        $order = order::find($id);
        $order->status = 0;
        $order->save();
        $orderdetail = orderdetail::where("order_id",$order->id)->get();
        foreach ($orderdetail as $i) {
            $i->status = 0;
            $i->save();
        }
        return redirect('admin/orderdetail');
    }

    public function check($id) {
        $order = order::find($id);
        $orderdetail = orderdetail::where("order_id",$order->id)->get();
        return view('orderdetail/check', compact('orderdetail'));
    }
}
