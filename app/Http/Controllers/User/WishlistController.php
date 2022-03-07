<?php

namespace App\Http\Controllers\User;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function AddToWishlist(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product_id)->first();
            if (!$exists) {
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $product_id;
                $wishlist->save();
                return response()->json(['success' => 'Product Add to wishlist!']);
            } else {
                return response()->json(['error' => 'Product Already is your wishlist!']);
            }
        } else {
            return response()->json(['error' => 'at firts you should login in your Account!']);
        }
    }


    public function ShowWishlistProduct()
    {
        $user_id = Auth::user()->id;
        $wishlists = Wishlist::with('product')->where('user_id', $user_id)->get();
        // dd($wishlists);
        return view('frontend.wishlist.show', compact('wishlists'));
    }


    public function WishlistRemove($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return response()->json(['success' => 'the product removed from wishlist successfully!']);
    }
}
