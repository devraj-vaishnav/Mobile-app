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

    public function create(){
        return view('admin.create');
    }
    public function store(Request $request){
    

    $request->validate([
        'name' => 'required|string|max:255',
        'email'=>'required|string|email|Max:255|unique:users',
        'password'=>'required|string|min:4|confirmed',

    ]);
     $data= new User();
     $data->name=$request->name;
     $data->email=$request->email;
     $data->password=Hash::make($request->password);
     $data->save();
     $data->assignRole('user');
     return redirect('admin/index');
    }

  
}
