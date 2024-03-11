<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expenses;
class ExpensesController extends Controller
{
    public function index()
    {  
         $user = Auth::user();
        $users=Expenses::where('user_id',$user->id)->get();
        return view('User.Expense.index',compact('users'));
    }
    public function create(){
        $user=Auth::user();
        return view('User.Expense.create',compact('user'));
    }

    public function store(Request $request){
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);
        $expense = new Expenses(); 
        $expense->name = $request->name;  
        $expense->price = $request->price;  
        $expense->user_id = $user->id;  
        $expense->save();
    
        return redirect('expense/index'); 
    }
 
    public function delete($id){
        Expenses::where('id', $id)->delete();
     return redirect('expense/index');
    }
    
    public function edit($id){
        $expense=  Expenses::find($id);
     return view('user/expense/edit', compact('expense'));
    }

    public function update(Request $request,$id){
        // dd($request,$id);
        $request->validate([
            'name'=>'required',
            'price'=>'required'
        ]);
        $update=Expenses::find($id);
        $update->name=$request->name;
        $update->price=$request->price;
        $update->save();
        return redirect('expense/index');

    }
}
