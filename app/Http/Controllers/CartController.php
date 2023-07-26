<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\order;
use App\Models\orderdetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct() {
    }
    public function viewCart() {
        $order = order::where("id_user",Auth::user()->id)->first();
        $orderdetail = orderdetail::where("order_id",$order->id)->get();
        
        return view('cart/index', compact('orderdetail'));
    }
    public function addToCart($id) {
        $order = order::where("id_user",Auth::user()->id)->first();
        if(!$order){
            $date=date("Ymd");
            $order = new order();
            $order->order_name = 'PO'.$date.random_int(0,9);
            $order->id_user = Auth::user()->id;
            $order->status = 0;
            $order->save();
        }
        
        $product = Product::find($id);
        $order = order::where("id_user",Auth::user()->id)->first();
        $orderdetail = orderdetail::where("order_id",$order->id)->get()->all();
        
        $stop = count($orderdetail);
        
        $c = 0;
        foreach ($orderdetail as $i) {
            if($i->order_id == $order->id){
                if($i->id_product == $product['id']){
                    if($i->status == 0){
                        $c = 4;
                        break;
                    }
                }
            }
        $c++;  
        }
        if($c == 4){
            $i->t_price += $product['price'];
            $i->qty += 1;
            $i->save();
        }
        if($c == $stop){
            $i = new orderdetail();
            $i->id_product = $product['id'];
            $i->order_id = $order->id;
            $i->t_price = $product['price'];
            $i->status = 0;
            $i->qty = 1;
            $i->save();
        }
        return redirect('cart/view');
    }
    public function deleteCart($id) {
        orderdetail::find($id)->delete();
        return redirect('cart/view');
    }
    
    public function updateCart($id, $qty) {
        
        $order = order::where("id_user",Auth::user()->id)->first();
        $orderdetail = orderdetail::find($id);
        $product = product::find($orderdetail->id_product);
        if($orderdetail){
            if($orderdetail->status == 0){
                $orderdetail->qty = (int)$qty;
                $orderdetail->t_price = $product['price'] * $qty;
                $orderdetail->save();
            }   
        }
        return redirect('cart/view');
    }
    public function checkout() {

        $order = order::where("id_user",Auth::user()->id)->first();
        $orderdetail = orderdetail::where("order_id",$order->id)->get();
        
        return view('cart/checkout', compact('orderdetail'));
    }

    public function complete(Request $request) {
        $cust_name = $request->name;
        $cust_email = $request->email;
        $total_amount = 0;

        $order = order::where("id_user",Auth::user()->id)->first();
        $orderdetail = orderdetail::where("order_id",$order->id)->get();
        
        foreach($orderdetail as $g) {
            $total_amount += $g->t_price;
        }
        $po = $order->order_name;
        $po_date = \Carbon\Carbon::parse($order->created_at)->format('d/m/Y');

        $html_output = view('cart/complete', compact('orderdetail', 'cust_name', 'cust_email','po','po_date', 'total_amount'))->render();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->debug = true;
        $mpdf->WriteHTML($html_output);
        $mpdf->Output('output.pdf', 'I');


        return $resp->withHeader("Content-type", "application/pdf");
    }
    public function finish_order() {
        $order = order::where("id_user",Auth::user()->id)->first();
        $orderdetail = orderdetail::where("order_id",$order->id)->get();
        $stop = count($orderdetail );
        $c = 0;
        foreach ($orderdetail as $i) {
            $i->status = 1;
            $i->save();
            $c+=$i->status;
        }
        if($stop == $c){
            $order->status = 1;
            $order->save();
        }
        return redirect('/home');
    }
}
