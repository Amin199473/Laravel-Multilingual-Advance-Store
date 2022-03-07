<?php

namespace App\Http\Controllers\Backend;

use PDF;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminOrderController extends Controller
{
    public function PendingOrders()
    {
        $pendingOrders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();

        return view('backend.adminOrders.pendingOrders', compact('pendingOrders'));
    }

    public function PendingOrdersDetails($id)
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $id)->orderBy('id', 'DESC')->get();
        return view('backend.adminOrders.orderDetails', compact('order', 'orderItems'));
    }

    public function ConfirmedOrders()
    {
        $confirmedOrders = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();

        return view('backend.adminOrders.confirmedOrders', compact('confirmedOrders'));
    }

    public function ProcessingOrders()
    {
        $processingOrders = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();

        return view('backend.adminOrders.processingOrders', compact('processingOrders'));
    }

    public function PickedOrders()
    {
        $pickedOrders = Order::where('status', 'picked')->orderBy('id', 'DESC')->get();

        return view('backend.adminOrders.pickedOrders', compact('pickedOrders'));
    }

    public function ShippedOrders()
    {
        $shippedOrders = Order::where('status', 'shipped')->orderBy('id', 'DESC')->get();

        return view('backend.adminOrders.shippedOrders', compact('shippedOrders'));
    }

    public function DeliveredOrders()
    {
        $deliveredOrders = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();

        return view('backend.adminOrders.deliveredOrders', compact('deliveredOrders'));
    }

    public function CanceledOrders()
    {
        $canceledOrders = Order::where('status', 'canceled')->orderBy('id', 'DESC')->get();

        return view('backend.adminOrders.canceledOrders', compact('canceledOrders'));
    }



    //update status to confirmed
    public function PendingToConfirmed($id)
    {
        $order = Order::findOrFail($id)->update(['status' => 'confirmed']);

        $notification = array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pendingOrders')->with($notification);
    }


    public function ConfirmedToProcessing($id)
    {
        $order = Order::findOrFail($id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('confirmedOrders')->with($notification);
    }

    public function ProcessingToPicked($id)
    {
        $order = Order::findOrFail($id)->update(['status' => 'picked']);

        $notification = array(
            'message' => 'Order Picked Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('processingOrders')->with($notification);
    }


    public function PickedToShipped($id)
    {
        $order = Order::findOrFail($id)->update(['status' => 'shipped']);

        $notification = array(
            'message' => 'Order Shipped Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('pickedOrders')->with($notification);
    }

    public function ShippedToDelivered($id)
    {
        // update product stock
        $orderItems = OrderItem::where('order_id', $id)->get();
        foreach ($orderItems as $item) {
            
            Product::where('id', $item->product_id)->update([
                'product_qty' => DB::raw('product_qty-' . $item->qty)
            ]);
        }

        $order = Order::findOrFail($id)->update(['status' => 'delivered']);

        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('shippedOrders')->with($notification);
    }

    public function DeliveredToCanceled($id)
    {
        $order = Order::findOrFail($id)->update(['status' => 'canceled']);

        $notification = array(
            'message' => 'Order Canceled Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('deliveredOrders')->with($notification);
    }



    public function AdminInvoiceDownload($id)
    {
        $order = Order::where('id', $id)->withTrashed()->first();
        $orderItems = OrderItem::where('order_id', $id)->orderBy('id', 'DESC')->withTrashed()->get();

        $pdf = PDF::loadView('frontend.userProfile.orderInvoice', compact('order', 'orderItems'));
        return $pdf->download('invoice.pdf');
    }
}
