<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ApproveReviewController extends Controller
{
    public function PendingReview(){
        $pendingReviews = Review::where('status',0)->latest()->get();
        return view('backend.review.pendingReview',compact('pendingReviews'));
    }

    public function ApprovedStore($id){
        Review::find($id)->update([
            'status'=>1
        ]);

        $notification = array(
            'message' => 'the Review Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ApprovedReviews(){
        $approvedReviews = Review::where('status',1)->latest()->get();
        return view('backend.review.approvedReview',compact('approvedReviews'));
    }

    public function ReviewDelete($id){
        $review = Review::find($id);
        $review->delete();

        $notification = array(
            'message' => 'the Review Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
