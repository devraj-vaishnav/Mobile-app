<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
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
    public function delete($id){
        User::where('id',$id)->delete();
        return redirect('admin/index');
    }
}
