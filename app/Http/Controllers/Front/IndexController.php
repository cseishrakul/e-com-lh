<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\Product;
use App\Models\Review;
use DB;
use Share;

class IndexController extends Controller
{
    // Root page controller

    public function index(){
        $category = Category::orderBy('category_name','ASC')->get();
        $brand = Brand::where('front_page',1)->limit(24)->get();
        $bannerProduct = Product::where('status',1)->where('product_slider',1)->latest()->first();
        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(16)->get();
        $today_deal = Product::where('status',1)->where('today_deal',1)->orderBy('id','DESC')->limit(6)->get();
        $popular_product = Product::where('status',1)->orderBy('product_views','DESC')->limit(16)->get();
        $trendy_product = Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $review = DB::table('wbreviews')->where('status',1)->orderBy('id','DESC')->limit(12)->get();
        // homepage category
        $home_category = DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();
        $campaign = DB::table('campaigns')->where('status',1)->orderBy('id','DESC')->first();
        return view('frontend.index',compact('category','bannerProduct','featured','popular_product','trendy_product','home_category','brand','random_product','today_deal','review','campaign'));
    }

    // single page product details method
    public function ProductDetails($slug){

        $product = Product::where('slug',$slug)->first();
        Product::where('slug',$slug)->increment('product_views');
        $related_product = Product::where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(10)->get();
        $review = Review::where('product_id',$product->id)->orderBy('id','DESC')->take(10)->get();

        $shareButtons = Share::page(
            url() -> current()
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();


        return view('frontend.product.product_details',compact('product','related_product','review','shareButtons'));
    }

    // Product Quick View
    public function ProductQuickView($id){
        $product = Product::where('id',$id)->first();
        return view('frontend.product.quick_view',compact('product'));
    }

    // Category Wise Product
    public function categorywiseProduct($id){
        $category = DB::table('categories')->where('id',$id)->first();
        $subcategory = DB::table('subcategories')->where('category_id',$id)->get();
        $brand = DB::table('brands')->get();
        $product = DB::table('products')->where('category_id',$id)->paginate(60);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.category_product',compact('subcategory','brand','product','random_product','category'));
    }

    // Subcategory Wise Product
    public function subcategorywiseProduct($id){
        $subcategory = DB::table('subcategories')->where('id',$id)->first();
        $childcategory = DB::table('childcategories')->where('subcategory_id',$id)->get();
        $brand = DB::table('brands')->get();
        $product = DB::table('products')->where('subcategory_id',$id)->paginate(60);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.subcategory_product',compact('childcategory','brand','product','random_product','subcategory'));
    }

    // Childcategory Wise Product
    public function childcategorywiseProduct($id){
        $childcategory = DB::table('childcategories')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $product = DB::table('products')->where('subcategory_id',$id)->paginate(60);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.childcategory_product',compact('childcategory','brand','product','random_product','category'));
    }

    // Brand Wise Product
    public function brandwiseProduct($id){
        $brand = DB::table('brands')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $product = DB::table('products')->where('subcategory_id',$id)->paginate(60);
        $random_product = Product::where('status',1)->inRandomOrder()->limit(16)->get();
        return view('frontend.product.brandwise_product',compact('brands','brand','product','random_product','category'));
    }

    // View Page
    public function ViewPage($page_slug){
        $page = DB::table('pages')->where('page_slug',$page_slug)->first();
        return view('frontend.page',compact('page'));
    }

    // Newsletter
    public function StoreNewsletter(Request $request){
        $email = $request->email;
        $check = Newsletter::where('email',$email)->first();
        if($check){
            return response()->json('Email Already Exists');
        }else{
            $data = array();
            $data['email'] = $request->email;
            Newsletter::insert($data);
            return response()->json('Tnx for subscribing us!');
        }
    }

    public function orderTracking(){
        return view('frontend.order_tracking');
    }

    // Contact Page
    public function ContactPage(){
        return view('frontend.contact');
    }

    public function CampaignProduct($id){
        $products = DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
        ->select('products.name','products.code','products.slug','products.thumbnail','campaign_product.*')
        ->where('campaign_product.campaign_id',$id)
        ->paginate(32);
        return view('frontend.campaign.product_list',compact('products'));
    }
}
