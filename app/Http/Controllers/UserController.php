<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Config, Validator;

class UserController extends Controller
{

    var $rp = 10;
    public function index() {
        $user = user::paginate($this->rp);
        $users = Session::get('users');
        $users = array();
        
        foreach ($user as $i) {
            $order = order::where("id_user",$i->id)->first();
            if($order){
                $s = $order->status;
            }else{
                $s = 0;
            }
            $users[$i['id']] = array( 
                'id' => $i->id,
                'name' => $i->name,
                'email' => $i->email,
                'time' => $i->created_at,
                'status' => $s,
            );
        }
       
        Session::put('users', $users);
        

        return view('user/index',compact('users'));
    }
    public function edit($id = null) {
        $user = User::find($id);
        if($id) {
            $user = User::where('id', $id)->first(); 
            return view('user/edit')
            ->with('user', $user);
        } 
        else {
            return view('user/add');

        }
        return view('user/edit')->with('user', $user);
    }
    public function update(Request $request) {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
        );
        
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
            :attribute ให้เป็นตัวเลข',
        );
        
        $id = $request->id;
        $temp = array(
            'name' => $request->name,
            'email' => $request->email,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/user/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('admin/user')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function insert(Request $request) {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        );
        
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
            :attribute ให้เป็นตัวเลข',
        );
        
        $id = $request->id;
        $temp = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/user/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect('admin/user')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    public function remove($id) {
        User::find($id)->delete();
        return redirect('admin/user')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
}
