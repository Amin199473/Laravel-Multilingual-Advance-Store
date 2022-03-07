<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\ShipDivision;
use Auth;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        if (Session::get('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);
        if ($product->discount_price == null) {
            Cart::add([
                'id' => $id,
                'name' => $request->productName,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => ['size' => $request->size, 'color' => $request->color, 'image' => $product->product_thumbnail]
            ])->associate('App\Models\Product');

            return response()->json(['success' => 'Product Add To Your Cart']);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->productName,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => ['size' => $request->size, 'color' => $request->color, 'image' => $product->product_thumbnail]
            ])->associate('App\Models\Product');;

            return response()->json(['success' => 'Product Add To Your Cart']);
        }
    }

    public function MiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }

    public function MiniCartRemove($rowId)
    {
        $cartRemove = Cart::remove($rowId);
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        return response()->json(['success' => 'Product removed from Your Cart!']);
    }


    public function ApplyCoupon(Request $request)
    {
        $coupon = Coupon::where('status', 1)
            ->where('coupon_name', $request->coupon_name)
            ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
            ->first();
        if ($coupon) {
            $discount_amount = round((Cart::total() * $coupon->coupon_discount) / 100);
            $total_amount = round((Cart::total() - $discount_amount));

            session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => $discount_amount,
                'total_amount' => $total_amount,
            ]);

            return response()->json([
                'validity' => true,
                'success' => 'The Coupon Applied Successfuly!'
            ]);
        } else {

            return response()->json(['error' => 'The Coupon is invalid!']);
        }
    }

    public function CouponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json(array(
                'cart_total' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total()
            ));
        }
    }

    public function CouponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'coupon removed successfuly']);
    }
}
