<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(){
        return view('user.category.index');

    }
    public function create(){
        return view('user.category.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|string'
        ]);
        $userId=Auth::id();
        $data=New Category();
        $data->name=$request->name;
        $data->user_id=$userId;
        $data->save();
        session()->flash('success_msg', " Successfully Added Category");

        return redirect('category/index');
    }
    public function getData(){
        $userId = Auth::id();
        $query=Category::where('user_id',$userId)->get();
      return DataTables::of($query)
      ->addIndexColumn()
      ->addColumn("DT_RowIndex",'')
      ->addColumn('action',function($datatables){
       return '<a href="' . route('category/edit', $datatables->id) . '" class=" btn btn-primary waves-effect waves-light " title="Edit Detail"><i class="mdi mdi-pencil d-block font-size-16"></i></a>
       <button onclick="deleteIt(' . $datatables->id . ')" class="btn btn-danger waves-effect waves-light "  title="Delete"><i class="mdi mdi-trash-can d-block font-size-16"></i></button>';
     })->make(true);
    }
    public function destory($id){
        $category = Category::find($id);
        $category->delete();
        return response()->json(['success',200]);
    }
    public function edit($id){
        $user=Category::find($id);
        return view('user.category.edit',compact('user'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required|string|max:100',
        ]);
        $update= Category::find($id);
        $update->name=$request->name;
        $update->save();
        session()->flash('success_msg', "Update  Details Successfully");

        return redirect('category/index');

    }
}
