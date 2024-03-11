<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('admin.profile',compact('user'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|string|email|Max:255|'
        ]);
        $update=User::find($id);
        $update->name=$request['name'];
        $update->email=$request['email'];
        $update->save();
        return redirect('profile/index');
    }

    public function password(Request $request,$id){

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $data = User::find($id);
       if(Hash::check($request->old_password,$data->password)){
         $data->password= Hash::make($request->password);
         $data->save();
         return redirect(route('profile/index'));
       }
       else{
         return redirect(route('profile/index'));
       }
    }


}

