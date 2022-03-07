<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReturnOrderController extends Controller
{
    public function ReturnOrder(){
        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();

        return view('backend.adminOrders.returnedOrders',compact('orders'));
    }

    public function ReturnOrderApprove($id){
        $order =Order::find($id);
        $order->update([
            'return_order'=> 2
        ]);

        $notification = array(
            'message' => 'Your Order Returned Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ReturnAllOrders(){
        $orders = Order::where('return_order',2)->orderBy('id','DESC')->get();
        return view('backend.adminOrders.AllReturns',compact('orders'));
    }
}
