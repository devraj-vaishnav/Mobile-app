<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;

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
      return redirect('income.index');
    }


    }
    


