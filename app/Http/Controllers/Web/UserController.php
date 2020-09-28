<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users=User::paginate(15);
        return view('User.index',compact('users'));
    }
}
