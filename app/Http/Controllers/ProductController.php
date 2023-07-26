<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Config, Validator;

class ProductController extends Controller
{
    // rp = Result per Page
    var $rp = 2;
    
    public function construct() {
        $this->middleware('auth');
    }

    public function index() {
        $products = Product::paginate($this->rp);
        return view('product/index', compact('products'));
    }
    public function search(Request $request){
        $query = $request->q;
        if($query) {
            $products = Product::where('code','like','%'.$query.'%')
            ->orWhere('name','like','%'.$query.'%')
            ->paginate($this->rp);
        }
        else{
            $products = Product::paginate($this->rp);
        }
        return view('product/index', compact('products'));
    }
    public function edit($id = null){
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', '');
        if($id){
            $product = Product::where('id',$id)->first(); return view('product/edit')
            ->with('product',$product)
            ->with('categories', $categories);
        }
        else{
            return view('product/add')->with('categories', $categories);;
        }

    }
    public function update(Request $request) {
        $rules = array(
        'code' => 'required', 'name' => 'required',
        'category_id' => 'required|numeric', 'price' => 'numeric',
        'stock_qty' => 'numeric',
        );
        
        $messages = array(
        'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
        :attribute ให้เป็นตัวเลข',
        );
        
        $id = $request->id;
        $temp = array(
        'name' => $request->name, //ทดลองฟิลด์เดียวก่อน
        'code' => $request->code,
        'category_id' => $request->category_id,
        );
        //ตรงนี้เป็นการนําค่าจากฟอร์ม มาใส่ตัวแปร array temp เพราะ class Validator ต้องการ array
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $product = Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;
        $product->save();

        if($request->hasFile('image')){
            $f = $request->file('image');
            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            $f->move($absolute_path, $f->getClientOriginalName());
            $product->image_url = $relative_path;
            $product->save();
        }

        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function insert(Request $request){
        $rules = array(
            'code' => 'required', 'name' => 'required',
            'category_id' => 'required|numeric', 'price' => 'numeric',
            'stock_qty' => 'numeric',
        );
            
            $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
            :attribute ให้เป็นตัวเลข',
        );
            
            $id = $request->id;
            $temp = array(
            'name' => $request->name, //ทดลองฟิลด์เดียวก่อน
            'code' => $request->code,
            'category_id' => $request->category_id,
        );
 
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;
        $product->save();
        if($request->hasFile('image'))
        {
            $f = $request->file('image');
            $upload_to = 'upload/images';
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            $f->move($absolute_path, $f->getClientOriginalName());
            $product->image_url = $relative_path;
            $product->save();



        }



        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแลว้');


    }
    public function remove($id){
        Product::find($id)->delete();
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสำเร็จ');
    }
}
