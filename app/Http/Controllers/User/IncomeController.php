<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class IncomeController extends Controller
{
    public function index(){
        $user=Auth::user();
        $incomes=Income::where('user_id',$user->id)->get();
        return view('user.income.index' , compact('incomes'));
    }

    public function create(){
        return view('user.income.create');
    }

    public function store(Request $request){
      $request->validate([
        'price'=>'required',
        'date'=>'required'
      ]);
      $user=Auth::user();
      $data=New Income();
      $data->price = $request->price;
      $data->date =date('Y-m-d',strtotime($request->date));
      $data->description = $request->description;
      $data->user_id=$user->id;
      $data->save();
      session()->flash('success_msg', " Successfully Added New  Income ");

      return redirect('income/index');
    }
    //  public function delete($id){
    //   Income::where('id',$id)->delete();
    //   return redirect('income/index');
    //  }
    public function destory($id){
      $product= Income::find($id);
      $product->delete();
      return response()->json(['success',200]);
  }
     public function edit($id){
      $user=Income::find($id);
      return view('user.income.edit',compact('user'));
     }


     public function update(Request $request,$id){
      // dd($request);
      $request->validate([
        'price'=>'required',
        'date'=>'required'
      ]);
      $update=Income::find($id);
      $update->price=$request->price;
      $update->date=date('Y-m-d',strtotime($request->date));
      $update->description=$request->description;
      $update->save();
      session()->flash('success_msg', " Successfully Update Income ");

      return redirect('income/index');
      

     }

     public function getData(){
        $userId = Auth::id();
        $query=Income::where('user_id',$userId)->get();
      return DataTables::of($query)
      ->addIndexColumn()
      ->addColumn("DT_RowIndex",'')
      ->editColumn('date', function($datatables) {
        return  date('d-m-Y', strtotime($datatables->date));
    })
      ->addColumn('action',function($datatables){
       return '<a href="' . route('income/edit', $datatables->id) . '" class=" btn btn-primary waves-effect waves-light " title="Edit Detail"><i class="mdi mdi-pencil d-block font-size-16"></i></a>
       <button onclick="deleteIt(' . $datatables->id . ')" class="btn btn-danger waves-effect waves-light "  title="Delete"><i class="mdi mdi-trash-can d-block font-size-16"></i></button>';
     })->make(true);
    }
  }
