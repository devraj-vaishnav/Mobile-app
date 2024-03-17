<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expenses;
use Yajra\DataTables\Facades\DataTables;

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
            'name' => 'required|string',
            'price' => 'required|integer'
        ]);
        $expense = new Expenses(); 
        $expense->name = $request->name;  
        $expense->price = $request->price;  
        $expense->user_id = $user->id;  
        $expense->save();
    
      session()->flash('success_msg', " Successfully Added");

        return redirect('expense/index'); 
    }
 
    // public function delete($id){
    //     Expenses::where('id', $id)->delete();
    //  return redirect('expense/index');
    // }
    public function destory($id){
        $product= Expenses::find($id);
        $product->delete();
        return response()->json(['success',200]);
    }
    
    public function edit($id){
        $expense=  Expenses::find($id);
     return view('user/expense/edit', compact('expense'));
    }

    public function update(Request $request,$id){
        // dd($request,$id);
        $request->validate([
            'name'=>'required|string|Max:55|',
            'price'=>'required|integer'
        ]);
        $update=Expenses::find($id);
        $update->name=$request->name;
        $update->price=$request->price;
        $update->save();
      session()->flash('success_msg', " Successfully Update");

        return redirect('expense/index');

    }
    public function getData(){
        $userId = Auth::id();
        $query=Expenses::where('user_id',$userId)->get();
      return DataTables::of($query)
      ->addIndexColumn()
      ->addColumn("DT_RowIndex",'')
      ->addColumn('action',function($datatables){
       return '<a href="' . route('expense/edit', $datatables->id) . '" class=" btn btn-primary waves-effect waves-light " title="Edit Detail"><i class="mdi mdi-pencil d-block font-size-16"></i></a>
       <button onclick="deleteIt(' . $datatables->id . ')" class="btn btn-danger waves-effect waves-light "  title="Delete"><i class="mdi mdi-trash-can d-block font-size-16"></i></button>';
     })->make(true);
    }
}
