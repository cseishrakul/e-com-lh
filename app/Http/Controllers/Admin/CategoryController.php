<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use DB;
use Illuminate\Support\Str;
use App\Models\Category;
use Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('categories')->get();
        return view('admin.category.category.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
            'icon' => 'required',
        ]);

        $slug = Str::slug($request->category_name, '-');

        $photo = $request->icon;
        $photoname = $slug.'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(32,32)->save('public/files/category/'.$photoname);
        // Eloquent ORM
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'home_page' => $request->home_page,
            'icon' => 'public/files/category/'.$photoname,
        ]);

        $notification = array('message' => 'Category Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        // $data=DB::table('categories')->where('id',$id)->first();
        $data = Category::findorfail($id);
        return view('admin.category.category.edit',compact('data'));
    }

    public function update(Request $request)
    {
        $slug = Str::slug($request->category_name,'-');
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name,'-');
        $data['home_page']=$request->home_page;
        if($request->icon){
            if(File::exists($request->old_icon)){
                unlink($request->old_icon);
            }
            $photo=$request->icon;
            $photoname=uniqid().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(32,32)->save('public/files/category/'.$photoname);
            $data['icon'] = 'public/files/category/'.$photoname;
            DB::table('categories')->where('id',$request->id)->update($data);

            $notification = array('message','Category Updated!','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }else{
            $data['icon']=$request->old_icon;
            DB::table('categories')->where('id',$request->id)->update($data);
            $notification = array('message','Category Updated!','alert-type'=>'success');
            return redirect()->back()->with($notification);
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        $notification = array('message' => 'Category Deleted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    // Get Child Category
    public function getChildCategory($id)
    {
        $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
        return response()->json($data);
    }
}
