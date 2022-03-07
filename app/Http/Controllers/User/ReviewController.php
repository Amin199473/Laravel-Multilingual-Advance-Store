<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function ReviewStore(Request $request)
    {
        $request->validate([
            'summary' => 'required',
            'comment' => 'required',
        ]);

        $findReview = Review::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($findReview) {

            $notification = array(
                'message' => 'You Already Add Your Review To This Product!',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            $review = new Review();
            $review->user_id = Auth::id();
            $review->product_id = $request->product_id;
            $review->summary = $request->summary;
            $review->comment = $request->comment;
            $review->rating = $request->rating;
            $review->save();

            $notification = array(
                'message' => 'the Review Will Approve by Admin',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    }
}
