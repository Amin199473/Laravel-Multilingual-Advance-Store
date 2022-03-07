<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class StripeController extends Controller
{
    public function StripeOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }


        \Stripe\Stripe::setApiKey('sk_test_51KQo68G98zTkDP1Oesqiia8ZnKvwZhsesTe8cldHv6tKpAlAyEavuuQSbFRTRziu6fzmTz3aRjv7bFYZAEBOfVrX00chVrLDPY');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount * 100,
            'currency' => 'usd',
            'description' => 'Test Payment',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        //inster data in order table
        $order = new Order();
        $order->user_id  = Auth::user()->id;
        $order->division_id = $request->division_id;
        $order->district_id = $request->district_id;
        $order->state_id = $request->state_id;
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->post_code = $request->post_code;
        $order->notes = $request->notes;
        $order->payment_type = $charge->payment_method;
        $order->payment_method = 'stripe';
        $order->transaction_id = $charge->balance_transaction;
        $order->currency = $charge->currency;
        $order->amount = $total_amount;
        $order->order_number = $charge->metadata->order_id;
        $order->invoice_no = 'EOS' . mt_rand(10000000, 99999999);
        $order->order_date = Carbon::now()->format('d F Y');
        $order->order_month = Carbon::now()->format('F');
        $order->order_year = Carbon::now()->format('Y');
        $order->status = 'pending';
        $order->save();

        $invoice = Order::findOrFail($order->id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $order->name,
            'email' => $order->email,
        ];
        Mail::to($request->email)->send(new OrderMail($data));


        //orerd item
        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->color = $item->options['color'];
            $orderItem->size = $item->options['size'];
            $orderItem->qty = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->save();
        }


        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'Your Order palced successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }
}
