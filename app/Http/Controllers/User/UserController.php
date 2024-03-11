<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
    return view('user.index');
   }

   

  
}
