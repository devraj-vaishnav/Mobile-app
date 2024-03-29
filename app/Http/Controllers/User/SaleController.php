<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use App\Models\SaleOrder;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    public function index()
    {
        return view('user.sale.index');
    }

    public function create()
    {
        $userId = Auth::id();
        $products = Product::where('user_id', $userId)->get();
        return view('user.sale.create', compact('products'));
    }

    public function getData(Request $request)
    {
        $productId = $request->id;
        $product = Product::find($productId);
        return view('user.sale.getdata', compact('product'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'customer_name' => 'required',
            'bill_date' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
        ]);
        $userId = Auth::id();
        $sale = new Sale();
        $sale->customer_name = $request->customer_name;
        $sale->bill_date = date('Y-m-d', strtotime($request->bill_date));
        $sale->mobile_no = $request->mobile_no;
        $sale->address = $request->address;
        $sale->user_id = $userId;
        $sale->save();

        $products = $request->product_id;
        $price = $request->price;
        $quality = $request->quality;
        $total = $request->total;
        foreach ($products as $key => $product) {
            $saleOrder = new SaleOrder;
            $saleOrder->customer_id = $sale->id;
            $saleOrder->product_id = $product;
            $saleOrder->price = $price[$key];
            $saleOrder->quality = $quality[$key];
            $saleOrder->total = $total[$key];
            $saleOrder->save();
        }
        session()->flash('success_msg', "Sale Added Successfully");
        return redirect('sale/index');
    }
    public function findData()
    {
        $userId = Auth::id();
        $query = Sale::where('user_id', $userId)->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn("DT_RowIndex", '')
            ->editColumn('date', function ($product) {
                return  date('d-M-Y', strtotime($product->bill_date));
            })
            ->addColumn('action', function ($product) {
                return '<a href="' . route('sale/edit', $product->id) . '" class="btn btn-primary waves-effect waves-light" title="Edit Detail"><i class="mdi mdi-pencil d-block font-size-16"></i></a>
                        <button onclick="deleteIt(' . $product->id . ')" class="btn btn-danger waves-effect waves-light" title="Delete"><i class="mdi mdi-trash-can d-block font-size-16"></i></button>';
            })
            ->make(true);
    }
    public function destory($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return response()->json(['success', 200]);
    }
    public function edit($id)
    {
        $sale = Sale::find($id);
        $saleOrders = SaleOrder::where('customer_id', $id)->get();
        $userId = Auth::id();
        $products = Product::where('user_id', $userId)->get();
        return view('user.sale.edit', compact('sale', 'saleOrders', 'products'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'customer_name' => 'required',
            'bill_date' => 'required',
            'mobile_no' => 'required',
            'address' => 'required',
        ]);
        $sale = Sale::find($id);
        $sale->customer_name = $request->customer_name;
        $sale->bill_date = date('Y-m-d', strtotime($request->bill_date));
        $sale->mobile_no = $request->mobile_no;
        $sale->address = $request->address;
        $sale->save();


        $products = $request->product_id;
        $price = $request->price;
        $quality = $request->quality;
        $total = $request->total;
        $old = $request->old;

        if (isset($products[0])) {
        foreach ($products as $key => $product) {
            if (!isset($old[$key])) {
                // Create new sale order 
                $saleorder = new SaleOrder;
                $saleorder->customer_id = $sale->id;
                $saleorder->product_id = $product;
                $saleorder->price = $price[$key];
                $saleorder->quality = $quality[$key];
                $saleorder->total = $total[$key];
            } else {
                // Update existing sale order
                $saleorder = SaleOrder::find($old[$key]);
                $saleorder->product_id = $product;
                $saleorder->price = $price[$key];
                $saleorder->quality = $quality[$key];
                $saleorder->total = $total[$key];
            }
            $saleorder->save();
        }
    }
        session()->flash('success_msg', " Successfully Update Sales ");
        return redirect('sale/index');
    }
    public function orderdestory($id)
    {
        $sale = SaleOrder::find($id);
        $sale->delete();
        return response()->json(['success', 200]);
    }
    
}
