<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Pickuppoint;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Product;
use File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Product Create Method

    public function create(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $pickup_point = DB::table('pickup_point')->get();
        $warehouse = DB::table('warehouses')->get();

        return view('admin.product.create',compact('category','brand','pickup_point','warehouse'));
    }

    // Product Store Method

    public function store(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required'
        ]);
        // Subcategory call for category id
        $subcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();
        $slug = Str::slug($request->name,'-');
        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name,'-');
        $data['code'] = $request->code;
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['unit'] = $request->unit;
        $data['tags'] = $request->tags;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['warehouse'] = $request->warehouse;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['description'] = $request->description;
        $data['video'] = $request->video;
        $data['featured'] = $request->featured;
        $data['today_deal'] = $request->today_deal;
        $data['product_slider'] = $request->product_slider;
        $data['status'] = $request->status;
        $data['trendy'] = $request->trendy;
        $data['admin_id'] = Auth::id();
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');

        // Single Image
        if($request->thumbnail){
            $thumbnail = $request->thumbnail;
            $photoname = $slug.'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600,600)->save('public/files/product/'.$photoname);
            $data['thumbnail'] = $photoname;
        }

        // multiple Images
        $images = array();
        if($request->hasFile('images')){
            foreach($request->file('images')as $key=>$image){
                $imagename = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(600,600)->save('public/files/product/'.$imagename);
                array_push($images, $imagename);
            }
            $data['images'] = json_encode($images);
        }

        DB::table('products')->insert($data);
        $notification = array('message' => 'Product Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    // Product show method
    public function index(Request $request){
        if($request->ajax()){
            $imageUrl = 'public/files/product';
            $product="";
              $query=DB::table('products')->leftJoin('categories','products.category_id','categories.id')
                    ->leftJoin('subcategories','products.subcategory_id','subcategories.id')
                    ->leftJoin('brands','products.brand_id','brands.id');

                if ($request->category_id) {
                    $query->where('products.category_id',$request->category_id);
                 }
                if ($request->brand_id) {
                    $query->where('products.brand_id',$request->brand_id);
                 }
                if ($request->warehouse) {
                    $query->where('products.warehouse',$request->warehouse);
                 }
                if ($request->status==1) {
                    $query->where('products.status',1);
                 }
                if ($request->status==0) {
                    $query->where('products.status',0);
                 }

            $product=$query->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                    ->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('thumbnail', function($row) use ($imageUrl){
                        return '<img src="'.$imageUrl.'/'.$row->thumbnail.'" height="30" width="30" />';
                    })
                    ->editColumn('featured', function($row){
                        if($row->featured == 1){
                            return '<a href="#" data-id="'.$row->id.'" class="dactive_featured"> <i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success"> active </span> </a>';
                        }else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_featured"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger"> dactive </span> </a>';
                        }
                    })
                    ->editColumn('today_deal', function($row){
                        if($row->today_deal == 1){
                            return '<a href="#" data-id="'.$row->id.'" class="dactive_today_deal"> <i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success"> active </span> </a>';
                        }else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_today_deal"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger"> dactive </span> </a>';
                        }
                    })
                    ->editColumn('status', function($row){
                        if($row->status == 1){
                            return '<a href="#" data-id="'.$row->id.'" class="dactive_status"> <i class="fas fa-thumbs-down text-danger"></i> <span class="badge badge-success"> active </span> </a>';
                        }else{
                            return '<a href="#" data-id="'.$row->id.'" class="active_status"> <i class="fas fa-thumbs-up text-success"></i> <span class="badge badge-danger"> dactive </span> </a>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn = '<a href="'.route('product.edit',[$row->id]).'" class="btn btn-info btn-sm edit"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-primary btn-sm edit"><i class="fas fa-eye"></i></a>
                        <a href="'.route('product.delete',[$row->id]).'" class="btn btn-danger btn-sm" id="delete_product"> <i class="fas fa-trash"></i> </a>';
                        return $actionbtn;
                    })
                    ->rawColumns(['action','category_name','subcategory_name','brand_name','thumbnail','featured','today_deal','status'])
                    ->make(true);
        }

        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $warehouse = DB::table('warehouses')->get();
        return view('admin.product.index', compact('category','brand','warehouse'));
    }

    // Not Featured Method
    public function notFeatured($id){
        DB::table('products')->where('id',$id)->update(['featured'=>0]);
        return response()->json('Product not featured!');
    }

    // Not Featured Method
    public function activeFeatured($id){
        DB::table('products')->where('id',$id)->update(['featured'=>1]);
        return response()->json('Product featured!');
    }

    // Deactive today Deal
    public function dactive_today_deal($id){
        DB::table('products')->where('id',$id)->update(['today_deal'=>0]);
        return response()->json('Today Deal Deactivated!');
    }
    // Aactive today Deal
    public function active_today_deal($id){
        DB::table('products')->where('id',$id)->update(['today_deal'=>1]);
        return response()->json('Today Deal Activated!');
    }

    // Deactive Status
    public function dactive_status($id){
        DB::table('products')->where('id',$id)->update(['status'=>0]);
        return response()->json('Status deactivated!');
    }

    // active Status
    public function active_status($id){
        DB::table('products')->where('id',$id)->update(['status'=>1]);
        return response()->json('Status Activated!');
    }

    public function destroy($id){
        $product = DB::table('products')->where('id',$id)->first();
        if(File::exists('public/files/product/'.$product->thumbnail)){
            File::delete('public/files/product/'.$product->thumbnail);
        }
        $images = json_decode($product->images,true);
        if(isset($image)){
            foreach($images as $key=>$image){
                if(File::exists('public/files/product/'.$image)){
                    File::delete('public/files/product/'.$image);
                }
            }
        }

        DB::table('products')->where('id',$id)->delete();
        return response()->json('Product Deleted Successfully!');
    }

    // Edit Function
    public function edit($id){
        $product = Product::findorfail($id);
        $category = Category::all();
        $brand = Brand::all();
        $warehouse = DB::table('warehouses')->get();
        $pickup_point = Pickuppoint::all();
        $childcategory = DB::table('childcategories')->where('category_id',$product->category_id)->get();
        return view('admin.product.edit',compact('product','category','brand','warehouse','pickup_point','childcategory'));
    }

    // update Function
    public function update(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'code' => 'required|max:55',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'unit' => 'required',
            'selling_price' => 'required',
            'color' => 'required',
            'description' => 'required'
        ]);
        // Subcategory call for category id
        $subcategory = DB::table('subcategories')->where('id',$request->subcategory_id)->first();

        $slug = Str::slug($request->name,'-');

        $data = array();
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name,'-');
        $data['code'] = $request->code;
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['unit'] = $request->unit;
        $data['tags'] = $request->tags;
        $data['purchase_price'] = $request->purchase_price;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['warehouse'] = $request->warehouse;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['description'] = $request->description;
        $data['video'] = $request->video;
        $data['featured'] = $request->featured;
        $data['today_deal'] = $request->today_deal;
        $data['product_slider'] = $request->product_slider;
        $data['status'] = $request->status;
        $data['trendy'] = $request->trendy;

        // Single Image

        $thumbnail = $request->file('thumbnail');
        if($thumbnail){
            $old_thumbnail = 'public/files/product/'.$request->old_thumbnail;
            if(File::exists($old_thumbnail)){
                File::delete($old_thumbnail);
            }
            $thumbnail = $request->thumbnail;
            $photoname = $slug.'.'.$thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600,600)->save('public/files/product/'.$photoname);

            $data['thumbnail'] = $photoname;
        }

        // multiple Images
        $old_images = $request->has('old_images');
        if($old_images){
            $images = $request->old_images;
            $data['images'] = json_encode($images);
        }else{
            $images = array();
            $data['images'] = json_encode($images);
        }
        if($request->hasFile('images')){
            foreach($request->file('images') as $key => $image){
                $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(600,600)->save('public/files/product/'.$imageName);
                array_push($images,$imageName);
            }
            $data['images'] = json_encode($images);
        }

        DB::table('products')->where('id',$request->id)->update($data);
        $notification = array('message' => 'Product Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

}
