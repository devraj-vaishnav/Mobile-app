<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('user.product.index');
    }
    public function create()
    {
        $userId = Auth::id();
        $categories = Category::where('user_id', $userId)->get();
        return view('user.product.create', compact('categories'));
    }
    public function store(Request $request)
   
    { 
        // dd($request);
        $request->validate([
            'category_id' => 'required|integer',
            'product_name' => 'required|string|Max:200',
            'price' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $userId = Auth::id();
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $filePath = 'images/' . $filename;
        Storage::disk('public')->put($filePath, file_get_contents($file));
        $product->image = $filePath;
        //  $file = $request->file('image');
        // $filename = $file->getClientOriginalName();
        // $filePath = 'images/' . $filename;
        // $imagePath  = $request->file('image')->store('images', 'public');
        // $product->image = $imagePath;
        $product->user_id = $userId;
        
        $product->save();
        session()->flash('success_msg', "Product Added Successfully");
        // session()->flash('success_msg'," Product Added sucessfull");
        return redirect('product/index');


    }

    public function getData()
    {
        $userId = Auth::id();
        $query = Product::where('products.user_id', $userId)
            ->join('categories', 'products.category_id', 'categories.id')
            ->select('products.*', 'categories.name as name')
            ->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn("DT_RowIndex", '')
            // ->editColumn('image', function($product) {
            //     return   '<img src="asset(storage/' . $product->image.' " width="100" height="100"/>';
            // })
            ->addColumn('action', function ($product) {
                return '<a href="' . route('product/edit', $product->id) . '" class="btn btn-primary waves-effect waves-light" title="Edit Detail"><i class="mdi mdi-pencil d-block font-size-16"></i></a>
                        <button onclick="deleteIt(' . $product->id . ')" class="btn btn-danger waves-effect waves-light" title="Delete"><i class="mdi mdi-trash-can d-block font-size-16"></i></button>';
            })
            ->make(true);
    }
    public function destory($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['success', 200]);
    }
    public function edit($id)
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)->get();
        $product = Product::find($id);
        return view('user.product.edit', compact('categories', 'product'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'price' => 'required',
        ]);
        $update = Product::find($id);
        $update->category_id = $request->category_id;
        $update->product_name = $request->product_name;
        $update->price = $request->price;
        $update->save();
        session()->flash('success_msg', "Update Product Details Successfully");

        return redirect('product/index');
    }
}
