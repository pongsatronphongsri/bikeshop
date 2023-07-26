<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Config, Validator;


class CategoryController extends Controller
{
    var $rp = 5;
    public function index() {
        $categories = Category::paginate($this->rp);
        return view('product/category/index', compact('categories'));
    }
    public function search(Request $request){
        $query = $request->q;
        if($query) {
            $categories = Category::where('id','like','%'.$query.'%')
            ->orWhere('name','like','%'.$query.'%')
            ->paginate($this->rp);
        }
        else{
            $categories = Category::paginate($this->rp);
        }
        return view('product/category/index', compact('categories'));
    }
    public function edit($id = null){
        $categories = Category::pluck('name','id')->prepend('เลือกรายการ',"");
        if($id){
            $categories = Category::where('id',$id)->first(); return view('product/category/edit')
            ->with('categories', $categories);
        }
        else{
            return view('product/category/add')->with('categories', $categories);
        }
    }
    public function update(Request $request) {
        $rules = array(
            'name' => 'required',
        );
        
        $messages = array(
        'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
        :attribute ให้เป็นตัวเลข',
        );
        
        $id = $request->id;
        $temp = array(
        'name' => $request->name, //ทดลองฟิลด์เดียวก่อน
        );
        //ตรงนี้เป็นการนําค่าจากฟอร์ม มาใส่ตัวแปร array temp เพราะ class Validator ต้องการ array
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/category/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        if($request->hasFile('image')){
            $f = $request->file('image');
            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            $f->move($absolute_path, $f->getClientOriginalName());
            $category->image_url = $relative_path;
            $category->save();
        }

        return redirect('product/category')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function insert(Request $request) {
        $rules = array(
             'name' => 'required',
        );
        
        $messages = array(
        'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
        :attribute ให้เป็นตัวเลข',
        );
        
        $id = $request->id;
        $temp = array(
        'name' => $request->name, //ทดลองฟิลด์เดียวก่อน
        );
        //ตรงนี้เป็นการนําค่าจากฟอร์ม มาใส่ตัวแปร array temp เพราะ class Validator ต้องการ array
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('product/category/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $category= new Category();
        $category->name = $request->name;
        $category->save();
        return redirect('product/category')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function remove($id){
        Category::find($id)->delete();
        return redirect('product/category')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสำเร็จ');
    }
    
}
