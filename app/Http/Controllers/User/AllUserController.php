<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class AllUserController extends Controller
{
    public function MyOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->orderBy('id', 'DESC')->withTrashed()->get();

        return view('frontend.userProfile.orders', compact('orders'));
    }

    public function MyOrderDetails($id)
    {
        $user_id = Auth::user()->id;
        $order = Order::where('id', $id)->where('user_id', $user_id)->withTrashed()->first();
        $orderItems = OrderItem::where('order_id', $id)->orderBy('id', 'DESC')->withTrashed()->get();
        return view('frontend.userProfile.orderDetails', compact('order', 'orderItems'));
    }

    public function InvoiceDownload($id)
    {
        $user_id = Auth::user()->id;
        $order = Order::where('id', $id)->where('user_id', $user_id)->withTrashed()->first();
        $orderItems = OrderItem::where('order_id', $id)->orderBy('id', 'DESC')->withTrashed()->get();


        $pdf = PDF::loadView('frontend.userProfile.orderInvoice', compact('order', 'orderItems'));
        return $pdf->download('invoice.pdf');
    }

    public function OrderReturnReason(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $order = Order::where('id', $id)->where('user_id', $user_id)->withTrashed()->first();
        $order->update([
            'return_date'=>Carbon::now()->format('d F Y'),
            'return_reason'=>$request->return_reason,
            'return_order'=> 1
        ]);

        $notification = array(
            'message' => 'Your Returened Order Request sent successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ReturnOrderList()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->where('return_reason', '!=', null)->orderBy('id', 'DESC')->withTrashed()->get();

        return view('frontend.userProfile.returnOrders', compact('orders'));
    }

    public function CancelOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id', $user_id)->where('status', 'canceled')->orderBy('id', 'DESC')->withTrashed()->get();

        return view('frontend.userProfile.orders', compact('orders'));
    }

    public function OrderTracking(Request $request){

        $invoice = $request->code ;
        $track = Order::where('invoice_no',$invoice)->first();

        if($track){


            return view('frontend.tracking.order_tracking',compact('track'));
        }else{
            $notification = array(
                'message' => 'Invoice Code Is invalid',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
