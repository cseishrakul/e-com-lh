<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // All Page Show Method
    public function index(){
        $page = DB::table('pages')->latest()->get();
        return view('admin.settings.page.index',compact('page'));
    }

    // Create Page Show Method
    public function create(){
        return view('admin.settings.page.create');
    }

    // Page Store Method
    public function store(Request $request){
        $data = array();
        $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_slug'] = Str::slug($request->page_name,'-');
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        
        DB::table('pages')->insert($data);
        $notification = array('message'=>'Pages Created Successfully!','alert-type' =>'success');

        return redirect()->back()->with($notification);

    }

    // Page Delete Method
    public function destroy($id){
        DB::table('pages')->where('id',$id)->delete();

        $notification = array('message' => 'Page Deleted Successfully!','alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    // Page Edit Method
    
    public function edit($id){
        $page = DB::table('pages')->where('id',$id)->first();
        return view('admin.settings.page.edit',compact('page'));
    }

    // Pade Update Method
    public function update(Request $request, $id){
        $data = array();
        $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_slug'] = Str::slug($request->page_name,'-');
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        
        DB::table('pages')->where('id',$id)->update($data);
        $notification = array('message'=>'Pages Updated Successfully!','alert-type' =>'success');

        return redirect()->route('page.index')->with($notification);
    }
}
