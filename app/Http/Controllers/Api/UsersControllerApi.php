<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersControllerApi extends Controller
{
    public function user_list() {
        $users = User::all();
        return response()->json(array ( 'ok' => true,
        'users' => $users,
        ));
    }
}
