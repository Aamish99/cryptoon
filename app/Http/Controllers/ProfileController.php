<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /*User profile*/
    public function profile(){
        return view('profile.index');
    }

    /*User alerts*/
    public function alerts(){
        $alerts = Alert::where('email', Auth::user()->email)->get();
        return view('profile.alerts', compact('alerts'));
    }

    /*User delete alert*/
    public function deleteAlerts($id){
        $alert = Alert::where(['email' => Auth::user()->email, 'id' => $id])->first();
        if($alert){
            $alert->delete();
        }
        return 'success';
    }

    /*User reviews*/
    public function reviews(){
        $reviews = Review::where('user_id', Auth::id())->get();
        return view('profile.reviews', compact('reviews'));
    }

    /*User delete review*/
    public function deleteReview($id){
        $review = Review::where(['id' => $id, 'user_id' => $id])->first();
        if($review){
            $review->delete();
        }
        return 'success';
    }

    /*User settings*/
    public function settings(){
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    /*User update settings*/
    public function updateSettings(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')){
            File::delete('uploads/'.$user->avatar);
            $file      = $request->avatar;
            $extention = $file->getClientOriginalExtension();
            $filename  = time().'-avatar.'.$extention;
            $file->move('uploads', $filename);
            $user->avatar = $filename;
        }
        $user->save();
        return redirect()->back()->withStatus(__('lang.user_updated_successfully'));


    }
}
