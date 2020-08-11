<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Coin;
use App\Models\Exchange;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('demo', ['only' => ['store', 'update', 'updateProfile']]);
    }
    /*
    * Admin dashboard
    ***********************/
    public function dashboard()
    {
        $users = User::count();
        $list_users = User::orderBy('id','desc')->get()->except(Auth::id());
        $exchanges = Exchange::count();
        $coins = Coin::count();
        $reviews = Review::count();
        return view('admin.dashboard', compact('users', 'exchanges', 'coins', 'reviews', 'list_users'));
    }

    /*
    * Get all users list
    ***********************/
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get()->except(Auth::id());
        return view('admin.users.index', compact('users'));
    }

    /*
    * Add new user
    ***********************/
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['sometimes']
        ]);

        $user = new User();
        if(isset($user)) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = (isset($request->role) ? '1' : '0');
            $user->save();
            return redirect()->back()->withStatus(__('lang.user_added_successfully'));
        }
        return redirect()->back()->withError(__('lang.user_not_found'));
    }

    /*
    * Edit a user
    ***********************/
    public function edit($id)
    {
        $user = User::find($id);
        echo view('admin.users.edit_request',compact('user'));
    }

    /*
    * Update a user
    ***********************/
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(isset($user)){
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => 'required|unique:users,email,'.$id,
                'password' => ['nullable', 'string', 'min:6', 'confirmed'],
                'role' => ['sometimes']
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            if(!empty($request->password)){
                $user->password = Hash::make($request->password);
            }
            $user->role = (isset($request->role) ? '1' : '0');
            $user->save();
            return redirect()->back()->withStatus(__('lang.user_updated_successfully'));
        }
        return redirect()->back()->withErrors(__('lang.user_not_found'));
    }

    /*
    * View user profile
    ***********************/
    public function profile(){
        $user = Auth::user();
        return view('admin.users.profile', compact('user'));
    }

    /*
    * Update user profile
    ***********************/
    public function updateProfile(Request $request){
        $user = Auth::user();
        if(isset($user)){
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => 'required|unique:users,email,'.$user->id,
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
        else{
            return redirect()->back()->withError(__('lang.user_not_found'));
        }
    }

    /*
    * Delete users
    ***********************/
    public function destroy(Request $request)
    {
        /*foreach ($request->id as $item){
            $user =  User::find($item);
            if($user)
                $user->delete();
        }
        return __('lang.user_delete_success');*/
        return 'demo';
    }

}
