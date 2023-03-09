<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setting(){
        return view('user.setting');
    }

    public function PasswordChange(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $curernt_password = Auth::user()->password;

        $old_password = $request->old_password;
        $new_password = $request->password;
        if(Hash::check($old_password, $curernt_password)){
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification = array('message' => 'Password updated!And you are logged out','alert-type' => 'success');

            return redirect()->to('/')->with($notification);
        }else{
            $notification = array('message' => 'Old Password not matched!','alert-type' => 'error');

            return redirect()->back()->with($notification);
        }
    }


    public function MyOrder(){
        $orders = DB::table('orders')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
        $total_order = DB::table('orders')->where('user_id',Auth::id())->count();
        $complete_order = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->count();
        $cancel_order = DB::table('orders')->where('user_id',Auth::id())->where('status',5)->count();
        $return_order = DB::table('orders')->where('user_id',Auth::id())->where('status',4)->count();
        return view('user.my_order',compact('orders','total_order','complete_order','cancel_order','return_order'));
    }

    public function ViewOrder($id){
        $order = DB::table('orders')->where('id',$id)->first();
        $order_details = DB::table('order_details')->where('order_id',$id)->get();
        return view('user.order_details',compact('order','order_details'));
    }

    // Tickets
    public function OpenTicket(){
        $tickets = DB::table('tickets')->where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();
        return view('user.ticket',compact('tickets'));
    }

    public function NewTicket(){
        return view('user.new_ticket');
    }

    public function StoreTicket(Request $request){
        $validated = $request->validate([
            'subject' => 'required'
        ]);

        $data = array();
        $data['subject'] = $request->subject;
        $data['service'] = $request->service;
        $data['priority'] = $request->priority;
        $data['message'] = $request->message;
        $data['user_id'] = Auth::id();
        $data['status'] = 0;
        $data['date'] = date('Y-m-d');

        if($request->image){
            $photo = $request->image;
            $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,350)->save('public/files/ticket/'.$photoname);
            $data['image']='public/files/ticket/'.$photoname;
        }

        DB::table('tickets')->insert($data);
        $notification = array('message' => 'Ticket Applied!', 'alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function ShowTicket(Request $request, $id){
        $tickets = DB::table('tickets')->where('id',$id)->first();
        return view('user.show_ticket',compact('tickets'));
    }

    public function ReplyTicket(Request $request){
        $validated = $request->validate([
            'message' => 'required',
        ]);

        $data = array();
        $data['message'] = $request->message;
        $data['ticket_id'] = $request->ticket_id;
        $data['user_id'] = Auth::id();
        $data['reply_date'] = date('Y-m-d');

        if($request->image){
            $photo = $request->image;
            $photoname = uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(600,350)->save('public/files/ticket/'.$photoname);
            $data['image'] = 'public/files/ticket/'.$photoname;
        }

        DB::table('replies')->insert($data);
        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>0]);
        $notification = array('message' => 'Replied Done!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function checkOrder(Request $request){
        $check = DB::table('orders')->where('order_id',$request->order_id)->first();

        if($check){
            $order = DB::table('orders')->where('order_id',$request->order_id)->first();
            $order_details = DB::table('order_details')->where('order_id',$order->id)->get();
            return view('frontend.order_details',compact('order','order_details'));
        }else{
            $notification = array('message' => 'Invalid Order Id!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
