<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use DB;
use Auth;

class CartController extends Controller
{
    public function addToCartQuickview(Request $request){
        // $product = Product::where('id',$request->id)->first();
        $product = Product::find($request->id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => '1',
            'options' => ['size' => $request->size, 'color' => $request->color, 'thumbnail' => $product->thumbnail]
        ]);
        return response()->json('Product added to cart!');
    }

    public function allCart(){
        $data = array();
        $data['cart_qty'] = Cart::count();
        $data['cart_total'] = Cart::total();
        return response()->json($data);

    }

    public function MyCart(){
        $content = Cart::content();
        return view('frontend.cart.cart',compact('content'));
    }

    public function removeCartProduct($rowId){
        Cart::remove($rowId);
        return response()->json('success');
    }

    public function updateQty($rowId, $qty){
        Cart::update($rowId, ['qty' => $qty]);
        return response()->json('Successfully Updated!');
    }

    public function updateColor($rowId, $color){
        $product = Cart::get($rowId);
        $thumbnail = $product->options->thumbnail;
        $size = $product->options->size;
        Cart::update($rowId, ['options' => ['color' => $color, 'thumbnail' => $thumbnail, 'size' => $size]]);
        return response()->json('Successfully Updated!');
    }

    public function updateSize($rowId, $size){
        $product = Cart::get($rowId);
        $thumbnail = $product->options->thumbnail;
        $color = $product->options->color;
        Cart::update($rowId, ['options' => ['size' => $size, 'thumbnail' => $thumbnail, 'color' => $color ]]);
        return response()->json('Successfully Updated!');
    }

    public function EmptyCart(){
        Cart::destroy();
        $notification = array('message' => 'Cart Item Cleared!', 'alert-type' => 'success');

        return redirect()->to('/')->with($notification);
    }


    // Wishlist
    public function Wishlist(){
        if(Auth::check()){
            $wishlist = DB::table('wishlists')->leftJoin('products','wishlists.product_id','products.id')->select('products.name','products.thumbnail','products.slug','wishlists.*')->where('wishlists.user_id',Auth::id())->get();
            return view('frontend.cart.wishlist',compact('wishlist'));
        }else{
            $notification = array('message' => 'Please Login First', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    // Wishlist Function
    public function AddWishlist($id){
        if(Auth::check()){
            $check = DB::table('wishlists')->where('product_id',$id)->where('user_id',Auth::id())->first();
            if($check){
                $notification = array('message' => 'Already you added to the wishlist', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }else{
                $data = array();
                $data['user_id'] = Auth::id();
                $data['product_id'] = $id;
                $data['date'] = Date('d,F Y');
                DB::table('wishlists')->insert($data);
    
                $notification = array(
                    'message' => 'Product Added To Wishlist',
                    'alert-type' => 'success'
                );
    
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Please login first',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
        
    }

    public function ClearWishlist(){
        DB::table('wishlists')->where('user_id',Auth::id())->delete();
        $notification = array('message' => 'Wishlist Cleared!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function DeleteWishlist($id){
        DB::table('wishlists')->where('id',$id)->delete();
        $notification = array('message' => 'One Item Cleared!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
