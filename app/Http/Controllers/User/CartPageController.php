<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session;

class CartPageController extends Controller
{
    public function MyCartPage()
    {
        return view('frontend.cart.cartPage');
    }

    public function UpdateCartQty(Request $request, $id)
    {
        if (Session::get('coupon')) {
            Session::forget('coupon');
        }
        if ($request->quantity < 0) {
            return response()->json(['error' => 'Quantity is not Valid!']);
        } else {
            Cart::update($id, $request->quantity);
            return response()->json(['success' => 'Quantity Updated Successfully!']);
        }
    }
}
