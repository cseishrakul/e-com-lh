<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use DB;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Str;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('childcategories')->leftJoin('categories','childcategories.category_id','categories.id')->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')->select('categories.category_name','subcategories.subcategory_name','childcategories.*')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',function($row){
                    $actionbtn = '<a href="" class="btn btn-info edit" data-id=" ' .$row->id.'" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href=" '.route('childcategory.delete',[$row->id]).' " class="btn btn-danger" id="delete"> <i class="fas fa-trash"></i>
                    </a>';

                    return $actionbtn;
                })
                -> rawColumns(['action'])
                ->make(true);
        }
        $category = Category::all();
        return view('admin.category.childcategory.index',compact('category'));
    }

    public function store(Request $request){
        $cat = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data = array();
        $data['category_id'] = $cat->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name,'-');
        $data['childcategory_name'] = $request->childcategory_name;

        DB::table('childcategories')->insert($data);
        $notification = array('message','Child Category Inserted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    public function delete($id){
        DB::table('childcategories')->where('id',$id)->delete();
        $notification = array('message','Child Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $category = DB::table('categories')->get();
        $data = DB::table('childcategories')->where('id',$id)->first();
        return view('admin.category.childcategory.edit',compact('category','data'));
    }

    public function update(Request $request){
        $cat = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $data = array();
        $data['category_id'] = $cat->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_slug'] = Str::slug($request->childcategory_name,'-');
        $data['childcategory_name'] = $request->childcategory_name;
        DB::table('childcategories')->where('id',$request->id)->update($data);
        $notification = array('message','Child Category Updated!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
}
