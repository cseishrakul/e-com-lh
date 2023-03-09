<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\front\CheckoutControler;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\HomeController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\CommonMark\Node\Block\IndentedCode;

Auth::routes();

// Customer Login & Register
route::get('/login', function () {
    return redirect()->to('/');
})->name('login');
route::get('/resgister', function () {
    return redirect()->to('/');
})->name('resgister');

// End Customer Login & Register

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');

// All Frontend Routes Here
Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::get('/product-details/{slug}', [IndexController::class, 'ProductDetails'])->name('product.details');
    Route::get('/product-quick-view/{id}', [IndexController::class, 'ProductQuickView']);

    // Cart Route
    Route::post('/addtocart', [CartController::class, 'addToCartQuickview'])->name('add.to.cart.quickview');
    Route::get('/all-cart', [CartController::class, 'allCart'])->name('all.cart');
    Route::get('/my-cart', [CartController::class, 'MyCart'])->name('cart');
    Route::get('/cartproduct/remove/{rowId}', [CartController::class, 'removeCartProduct']);
    Route::get('/cartproduct/updateqty/{rowId}/{qty}', [CartController::class, 'updateQty']);
    Route::get('/cartproduct/updatecolor/{rowId}/{color}', [CartController::class, 'updateColor']);
    Route::get('/cartproduct/updatesize/{rowId}/{size}', [CartController::class, 'updateSize']);
    Route::get('/cart/empty', [CartController::class, 'EmptyCart'])->name('cart.empty');

    // Checkout
    Route::get('checkout/',[CheckoutControler::class,'checkout'])->name('checkout');
    Route::post('/apply/coupon',[CheckoutControler::class,'coupon_apply'])->name('apply.coupon');
    Route::get('/remove/coupon',[CheckoutControler::class,'coupon_remove'])->name('coupon.remove');
    // order place
    Route::post('/order/place',[CheckoutControler::class,'OrderPlace'])->name('order.place');

    //Add Wishlist 
    Route::get('/wishlist', [CartController::class, 'Wishlist'])->name('wishlist');
    Route::get('/add/wishlist/{id}', [CartController::class, 'AddWishlist'])->name('add.wishlist');
    Route::get('/clear/wishlist/', [CartController::class, 'ClearWishlist'])->name('wishlist.clear');
    Route::get('/delete/wishlist/{id}', [CartController::class, 'DeleteWishlist'])->name('wishlist.delete');


    // Category Wise Product Show
    Route::get('/category/product/{id}', [IndexController::class, 'categorywiseProduct'])->name('categorywise.product');

    // Subcategory Wise Product Show
    Route::get('/subcategory/product/{id}', [IndexController::class, 'subcategorywiseProduct'])->name('subcategorywise.product');

    // Childcategory Wise Product Show
    Route::get('/childcategory/product/{id}', [IndexController::class, 'childcategorywiseProduct'])->name('childcategorywise.product');

    // Brand Wise Product Show
    Route::get('/brand/product/{id}', [IndexController::class, 'brandwiseProduct'])->name('brandwise.product');

    // Product Review Route
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

    // Write Review For Website
    Route::get('/review/write',[ReviewController::class,'revieWrite'])->name('write.review');
    Route::post('/store/website/review',[ReviewController::class,'storeRevieWebsite'])->name('store.review.website');

    // User Profile Setting
    Route::get('/home/setting',[ProfileController::class,'setting'])->name('customer.setting');
    Route::post('/home/password/change',[ProfileController::class,'PasswordChange'])->name('customer.password.change');
    Route::get('my/order',[ProfileController::class,'MyOrder'])->name('my.order');
    Route::get('view/order/{id}',[ProfileController::class,'ViewOrder'])->name('view.order');
    Route::post('check/order/',[ProfileController::class,'checkOrder'])->name('check.order');

    // View Pages
    Route::get('page/{page_slug}',[IndexController::class,'ViewPage'])->name('page.view'); 
    Route::get('order/tracking',[IndexController::class,'orderTracking'])->name('order.tracking'); 

    // Newsletter
    Route::post('store/newsletter',[IndexController::class,'StoreNewsletter'])->name('store.newsletter');

    // Open Ticket
    Route::get('/open/ticket',[ProfileController::class,'OpenTicket'])->name('open.ticket');
    Route::get('/new/ticket',[ProfileController::class,'NewTicket'])->name('new.ticket');
    Route::post('/store/ticket',[ProfileController::class,'StoreTicket'])->name('store.ticket');
    Route::get('/show/ticket/{id}',[ProfileController::class,'ShowTicket'])->name('show.ticket');
    Route::post('/reply/ticket./',[ProfileController::class,'replyTicket'])->name('reply.ticket');


    // Contact page
    Route::get('contact',[IndexController::class,'ContactPage'])->name('contact');

    // Campaign
    Route::get('/campaign/products/{id}',[IndexController::class,'CampaignProduct'])->name('frontend.campaign.products');
});

// Socialite
Route::get('oauth/{driver}',[App\Http\Controllers\Auth\LoginController::class,'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback',[App\Http\Controllers\Auth\LoginController::class,'handleProviderCallback'])->name('social.callback');