<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /*
    * Get list of all reviews
    ***********************/
    public function index(){
        $reviews = Review::orderBy('id', 'desc')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    /*
    * View reviews
    ***********************/
    public function view($id){
        $review = Review::find($id);
        if(isset($review))
            return view('admin.reviews.view', compact('review'));

        return 'error';
    }

    /*
    * Delete reviews
    ***********************/
    public function destroy(Request $request)
    {
        /*foreach ($request->id as $item){
            $review =  Review::find($item);
            if(isset($review))
                $review->delete();
        }
        return __('lang.review_delete_success');*/
        return 'demo';
    }
}
