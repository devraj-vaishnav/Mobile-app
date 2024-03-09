<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('user.profile',compact('user'));
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
        return redirect('profile');
    }
    public function forgot(Request $request,$id){

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $data = User::find($id);
       if(Hash::check($request->old_password,$data->password)){
         $data->password= Hash::make($request->password);
         $data->save();
         return redirect(url('profile'));
       }
       else{
        return redirect(url('profile'));
        
       }
    }
}
