<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\transaction;
use App\Models\product;
use Illuminate\Http\Request;

use Illuminate\Support\facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        $products = product::all();
        $orders = Order::all();
          //    Lets Order Details
        $lastID = OrderDetail :: max('order_id');
       $order_receipt = OrderDetail::where('order_id',$lastID)->get();
        return view('orders.index',['products'=>$products,'orders'=>$orders, 'order_receipt' =>$order_receipt]);
    }

    public function store(Request $request)
    {
    //    return $request->all();

        DB::transaction(function () use ($request) {
            
      

        // Order Modal
        $orders = new order;
           $orders-> name= $request->customer_name;
           $orders-> phone= $request->customer_phone;
           $orders->save();
           $order_id =$orders->id;

           
        // Order Details Modal
        for($product_id=0; $product_id < count($request->product_id); $product_id++){

            $order_details =new OrderDetail;
            $order_details->order_id = $order_id;
            $order_details->product_id = $request->product_id[$product_id];
            $order_details->unitprice = $request->price [$product_id];
            $order_details->quantity = $request->quantity [$product_id];
            $order_details->discount = $request->discount[$product_id];
            $order_details->amount = $request->product_amount [$product_id];
            $order_details->save();

        }
      
        //Transaction Modal
        $transaction =new transaction();
        $transaction->order_id = $order_id;
        $transaction->user_id = auth()->user()->id;
        $transaction->balance = $request->balance;
        $transaction->paid_amount = $request->paid_amount;
        $transaction->payment_method = $request->payment_method;
        $transaction->transac_amount = $order_details->amount;
        $transaction->transac_date = date('y-m-d');
        $transaction->save();

       //Last Order Histroy
       $products = Product::all();
       $order_details = OrderDetail::where('order_id',$order_id)->get();
       $orderedBy =Order::where('id', $order_id)->get();

       return view('orders.index',
       [
         'products' => $products,
         'order_details' =>$order_details,
         'customer_orders'=>$orderedBy
       ]);

     });

     return back()->with("Product Orders Fails to inserted!check your inputs!");

  
    }
}
