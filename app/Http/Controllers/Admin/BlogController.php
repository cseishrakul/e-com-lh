<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Image;
use File;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data = DB::table('blog_category')->get();
        return view('admin.blog.category',compact('data'));
    }

    public function categoryStore(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|max:55',
        ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name,'-');
        DB::table('blog_category')->insert($data);

        $notification = array('message' => 'Blog Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function destroy($id){
        DB::table('blog_category')->where('id',$id)->delete();
        $notification = array('message' => 'Blog Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function categoryEdit($id){
        $data = DB::table('blog_category')->where('id',$id)->first();
        return view('admin.blog.category_edit',compact('data'));
    }

    public function categoryUpdate(Request $request){
        $data=array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name,'-');
        DB::table('blog_category')->where('id',$request->id)->update($data);

        $notification = array('message' => 'Blog Category Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
