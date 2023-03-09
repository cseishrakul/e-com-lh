<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Auth;
use DB;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        $check = Review::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();

        if($check){
            $notification = array('message' => 'Already You Have A Review In This Product', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $review = new Review;
        $review->user_id = Auth::id();
        $review->product_id = $request->product_id;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->review_date = date('d-m-y');
        $review->review_month = date('F');
        $review->review_year = date('Y');
        $review->save();
        $notification = array('message' => 'Thanks For Your Review!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);

    }

    // Website Review Function
    public function revieWrite(){
        return view('user.review_write');
    }

    // Website review store
    public function storeRevieWebsite(Request $request){
        $check = DB::table('wbreviews')->where('user_id',Auth::id())->first();
        if($check){
            $notification = array('message' => 'Review already exists','alert-type' => 'success');
            return redirect()->back()->with($notification);
        }else{
            $data = array();
            $data['user_id'] = Auth::id();
            $data['name'] = Auth::user()->name;
            $data['review'] = $request->review;
            $data['rating'] = $request->rating;
            $data['review_date'] = date("d, F Y");
            $data['status'] = 0;
            DB::table('wbreviews')->insert($data);
            $notification = array('message' => 'Review Added!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
    
}
