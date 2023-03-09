<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use DB;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data = DB::table('users')->where('is_admin',1)->where('role_admin',1)->get();

        return view('admin.role.index',compact('data'));
    }

    public function create(){
        return view('admin.role.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'email' => 'required|unique:users',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['category'] = $request->category;
        $data['product'] = $request->product;
        $data['offer'] = $request->offer;
        $data['order'] = $request->order;
        $data['blog'] = $request->blog;
        $data['pickup'] = $request->pickup;
        $data['ticket'] = $request->ticket;
        $data['contact'] = $request->contact;
        $data['report'] = $request->report;
        $data['setting'] = $request->setting;
        $data['userrole'] = $request->userrole;
        $data['is_admin'] = 1;
        $data['role_admin'] = 1;

        DB::table('users')->insert($data);
        $notification = array('message' => 'Role Created!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $data = DB::table('users')->where('id',$id)->first();
        return view('admin.role.edit',compact('data'));
    }

    public function update(Request $request){
        $id = $request->id;
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['category'] = $request->category;
        $data['product'] = $request->product;
        $data['offer'] = $request->offer;
        $data['order'] = $request->order;
        $data['blog'] = $request->blog;
        $data['pickup'] = $request->pickup;
        $data['ticket'] = $request->ticket;
        $data['contact'] = $request->contact;
        $data['report'] = $request->report;
        $data['setting'] = $request->setting;
        $data['userrole'] = $request->userrole;

        DB::table('users')->where('id',$id)->update($data);
        $notification = array('message' => 'Role Updated!', 'alert-type' => 'success');

        return redirect()->route('manage.role')->with($notification);
    }

    public function delete($id){
        DB::table('users')->where('id',$id)->delete();
        $notification = array('message' => 'Role Deleted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
}
