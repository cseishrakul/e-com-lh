<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Admin After login
    public function admin(){
        $customers = DB::table('users')->where('is_admin','0')->orWhere('is_admin',NULL)->orderBy('id','DESC')->limit(8)->get();
        $latest_order = DB::table('orders')->orderBy('id','DESC')->limit(8)->get();
        $most_views = DB::table('products')->orderBy('product_views','DESC')->where('status',1)->limit(8)->get();
        $product = DB::table('products')->count();
        $active_product = DB::table('products')->where('status',1)->count();
        $inactive_product = DB::table('products')->where('status',0)->count();
        $allcustomer = DB::table('users')->where('is_admin','0')->orWhere('is_admin',NULL)->count();
        $category = DB::table('categories')->count();
        $brand= DB::table('brands')->count();
        $ticket = DB::table('tickets')->where('status',0)->count();
        $review = DB::table('reviews')->count();
        $cupon = DB::table('cupons')->count();
        $subscribers = DB::table('newsletters')->count();
        $pending_order = DB::table('orders')->where('status',0)->count();
        $success_order = DB::table('orders')->where('status',3)->count();

        return view('admin.home',compact('customers','latest_order','most_views','product','active_product','inactive_product','allcustomer','category','brand','ticket','review','cupon','subscribers','pending_order','success_order'));
    }

    // Admin After Logout
    public function logout(){
        Auth::logout();
        // $notification = array('message' => 'You are logged out!', 'alert-type' => 'success');
        return redirect()->route('admin.login');
    }

    // Admin Password Change
    public function passwordChange(){
        return view('admin.profile.password_change');
    }

    // Admin Password  Update
    public function passwordUpdate(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        $current_password = Auth::user()->password;

        $oldPass = $request->old_password;
        $new_password = $request->password;

        if(Hash::check($oldPass, $current_password)){
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            // $notification = array('message' => 'Password Changed!', 'alert-type' => 'success');
            return redirect()->route('admin.login');
        }else{
            // $notification = array('message' => 'Your old password doesnt matched!','alert-type' => 'error');
        }

        return redirect()->back();
    }
}
