<?php

namespace App\Http\Controllers\User;

use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function CheckoutCreate()
    {
        // check user if login
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
                return view('frontend.checkout.index', compact('divisions'));
            } else {
                $notification = array(
                    'message' => 'You should shipping at least one product',
                    'alert-type' => 'error',
                );
                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'You need to login at first',
                'alert-type' => 'error',
            );
            return redirect()->route('login')->with($notification);
        }
    }

    public function CheckoutStore(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;

        if ($request->payment_method == 'stripe') {
            return view('frontend.payment.stripe', compact('data'));
        } elseif ($request->payment_method == 'card') {
            return 'card';
        } else {
            return view('frontend.payment.cash', compact('data'));
        }
    }
}
