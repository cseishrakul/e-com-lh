<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Image;
use File;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('brands')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('front_page', function ($row) {
                    if ($row->front_page == 1) {
                        return '<span class="badge badge-success"> Home Page </span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="" class="btn btn-info btn-sm edit" data-id=" ' . $row->id . '" data-toggle="modal" data-target="#editModal" id="edit"> <i class="fas fa-edit"></i> </a>
                    <a href="' . route('brand.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete"> <i class="fas fa-trash"></i> </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'front_page'])
                ->make(true);
        }
        return view('admin.category.brand.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:55'
        ]);

        $slug = Str::slug($request->brand_name, '-');

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        $data['front_page'] = $request->front_page;


        $photo = $request->brand_logo;
        $photoname = $slug . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(240, 120)->save('public/files/brand/' . $photoname);
        $data['brand_logo'] = 'public/files/brand/' . $photoname;
        DB::table('brands')->insert($data);

        $notification = array('message', 'Brand Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $data = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;

        if (File::exists($image)) {
            unlink($image);
        }

        DB::table('brands')->where('id', $id)->delete();
        $notification = array('message', 'Brand Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $data = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.brand.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $slug = Str::slug($request->brand_name, '-');
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_slug'] = Str::slug($request->brand_name, '-');
        $data['front_page'] = $request->front_page;
        if ($request->brand_logo) {
            if (File::exists($request->old_logo)) {
                unlink($request->old_logo);
            }
            $photo = $request->brand_logo;
            $photoname = $slug . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(240, 120)->save('public/files/brand/' . $photoname);
            $data['brand_logo'] = 'public/files/brand/' . $photoname;
            DB::table('brands')->where('id', $request->id)->update($data);

            $notification = array('message', 'Brand Updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $data['brand_logo'] = $request->old_logo;
            DB::table('brands')->where('id', $request->id)->update($data);
            $notification = array('message', 'Brand Updated!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
}
