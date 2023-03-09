<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CampaignProduct;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\WarehouseController;
use Illuminate\Support\Facades\Route;

// Route::get('/admin/home',[HomeController::class,'admin'])->name('admin.home')->middleware('is_admin');
Route::get('/admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('admin/home', [AdminController::class, 'admin'])->name('admin.home');
    Route::get('admin/password/change', [AdminController::class, 'passwordChange'])->name('admin.password.change');
    Route::post('admin/password/update', [AdminController::class, 'passwordUpdate'])->name('admin.password.update');
    Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Category routes
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('update/', [CategoryController::class, 'update'])->name('category.update');
    });

    // global route

    Route::get('/get-child-category/{id}', [CategoryController::class, 'getChildCategory']);

    // Subcategory routes
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', [SubcategoryController::class, 'index'])->name('subcategory.index');
        Route::post('/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/delete/{id}', [SubcategoryController::class, 'delete'])->name('subcategory.delete');
        Route::get('/edit/{id}', [SubcategoryController::class, 'edit']);
        Route::post('update/', [SubcategoryController::class, 'update'])->name('subcategory.update');
    });

    // Childcategory routes
    Route::group(['prefix' => 'childcategory'], function () {
        Route::get('/', [ChildcategoryController::class, 'index'])->name('childcategory.index');
        Route::post('/store', [ChildcategoryController::class, 'store'])->name('childcategory.store');
        Route::get('/delete/{id}', [ChildcategoryController::class, 'delete'])->name('childcategory.delete');
        Route::get('/edit/{id}', [ChildcategoryController::class, 'edit']);
        Route::post('update/', [ChildcategoryController::class, 'update'])->name('childcategory.update');
    });

    // Brand routes
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
        Route::get('/edit/{id}', [BrandController::class, 'edit']);
        Route::post('update/', [BrandController::class, 'update'])->name('brand.update');
    });

    // Warehouse Setting routes
    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
        Route::post('/store', [WarehouseController::class, 'store'])->name('warehouse.store');
        Route::get('/delete/{id}', [WarehouseController::class, 'delete'])->name('warehouse.delete');
        Route::get('/edit/{id}', [WarehouseController::class, 'edit']);
        Route::post('/update', [WarehouseController::class, 'update'])->name('warehouse.update');
    });

    // Setting routes
    Route::group(['prefix' => 'setting'], function () {
        // Seo Setting routes
        Route::group(['prefix' => 'seo'], function () {
            Route::get('/', [SettingController::class, 'seo'])->name('seo.setting');
            Route::post('/update/{id}', [SettingController::class, 'seoUpdate'])->name('seo.setting.update');
        });
        // Smtp Setting routes
        Route::group(['prefix' => 'smtp'], function () {
            Route::get('/', [SettingController::class, 'smtp'])->name('smtp.setting');
            Route::post('/update/{id}', [SettingController::class, 'smtpUpdate'])->name('smtp.setting.update');
        });

        // Page Setting routes
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', [PageController::class, 'index'])->name('page.index');
            Route::get('/create', [PageController::class, 'create'])->name('page.create');
            Route::post('/store', [PageController::class, 'store'])->name('page.store');
            Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
            Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
        });

        // Website Setting routes
        Route::group(['prefix' => 'website'], function () {
            Route::get('/', [SettingController::class, 'website'])->name('website.setting');
            Route::post('/update/{id}', [SettingController::class, 'websiteUpdate'])->name('website.setting.update');
        });
        // Payment Gateway Setting routes
        Route::group(['prefix' => 'payment-gateway'], function () {
            Route::get('/', [SettingController::class, 'PaymentGateway'])->name('payment.gateway');
            Route::post('/update-amerpay', [SettingController::class, 'UpdateAamerpay'])->name('update.aamerpay');
            Route::post('/update-surjopay', [SettingController::class, 'UpdateSurjopay'])->name('update.surjopay');
            Route::post('/update-ssl', [SettingController::class, 'UpdateSsl'])->name('update.ssl');
        });
    });

    // Cupon routes
    Route::group(['prefix' => 'cupon'], function () {
        Route::get('/', [CuponController::class, 'index'])->name('cupon.index');
        Route::post('/store', [CuponController::class, 'store'])->name('cupon.store');
        Route::delete('/delete/{id}', [CuponController::class, 'delete'])->name('cupon.delete');
        Route::get('/edit/{id}', [CuponController::class, 'edit']);
        Route::post('/update', [CuponController::class, 'update'])->name('cupon.update');
    });

    // Campaign routes
    Route::group(['prefix' => 'campaign'], function () {
        Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
        Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
        Route::get('/delete/{id}', [CampaignController::class, 'delete'])->name('campaign.delete');
        Route::get('/edit/{id}', [CampaignController::class, 'edit']);
        Route::post('/update', [CampaignController::class, 'update'])->name('campaign.update');
    });

    // Campaign Product routes
    Route::group(['prefix' => 'campaign-product'], function () {
        Route::get('/{campaign_id}', [CampaignProduct::class, 'index'])->name('campaign.product');
        Route::get('/{id}/{campaign_id}', [CampaignProduct::class, 'ProductAddToCampaign'])->name('add.product.to.campaign');
        Route::get('/list/{campaign_id}', [CampaignProduct::class, 'ProductList'])->name('campain.product.list');
        Route::get('/remove/{id}', [CampaignProduct::class, 'ProductRemove'])->name('product.remove.campaign');
    });


    // Order routes
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
        Route::get('/admin/edit/{id}',[OrderController::class,'edit']);
        Route::post('/update/order/status',[OrderController::class,'updateStatus'])->name('update.order.status');
        Route::get('/admin/view/{id}',[OrderController::class,'viewOrder']);
        Route::get('/delete/{id}',[OrderController::class,'delete'])->name('order.delete');
    });

    // Pickup Point routes
    Route::group(['prefix' => 'pickup-point'], function () {
        Route::get('/', [PickupController::class, 'index'])->name('pickuppoint.index');
        Route::post('/store', [PickupController::class, 'store'])->name('pickuppoint.store');
        Route::delete('/delete/{id}', [PickupController::class, 'delete'])->name('pickuppoint.delete');
        Route::get('edit/{id}', [PickupController::class, 'edit']);
        Route::post('/update', [PickupController::class, 'update'])->name('pickuppoint.update');
    });

    // Product routes
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/not-featured/{id}', [ProductController::class, 'notFeatured']);
        Route::get('/active-featured/{id}', [ProductController::class, 'activeFeatured']);
        Route::get('/dactive_today_deal/{id}', [ProductController::class, 'dactive_today_deal']);
        Route::get('/active_today_deal/{id}', [ProductController::class, 'active_today_deal']);
        Route::get('/dactive_status/{id}', [ProductController::class, 'dactive_status']);
        Route::get('/active_status/{id}', [ProductController::class, 'active_status']);
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/update',[ProductController::class,'update'])->name('product.update');

    });

    // Ticket routes
    Route::group(['prefix' => 'ticket'], function () {
        Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
        Route::get('/show/ticket/{id}', [TicketController::class, 'show'])->name('admin.ticket.show');
        Route::post('/reply/ticket/', [TicketController::class, 'ReplyTicket'])->name('admin.store.reply');
        Route::get('/close/ticket/{id}', [TicketController::class, 'closeTicket'])->name('admin.close.ticket');
        Route::get('/admin/ticket/delete/{id}', [TicketController::class, 'TicketDelete'])->name('admin.ticket.delete');
    });


    // Blog Category routes
    Route::group(['prefix' => 'blog-category'], function () {
        Route::get('/', [BlogController::class, 'index'])->name('admin.blog.category');
        Route::post('/blog/category/store', [BlogController::class, 'categoryStore'])->name('blog.category.store');
        Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.category.delete');
        Route::get('/edit/{id}', [BlogController::class, 'categoryEdit']);
        Route::post('blog/category/update', [BlogController::class, 'categoryUpdate'])->name('blog.category.update');
    });

    // Report Route
    Route::group(['prefix' => 'report'],function(){
        Route::get('/order',[OrderController::class,'reportIndex'])->name('report.order.index');
        Route::get('/order/print',[OrderController::class,'orderPrint'])->name('report.order.print');
    });

    // User Role Management
    Route::group(['prefix' => 'role'],function(){
        Route::get('/',[RoleController::class,'index'])->name('manage.role');
        Route::get('/create',[RoleController::class,'create'])->name('create.role');
        Route::post('/store',[RoleController::class,'store'])->name('role.store');
        Route::get('/delete/{id}',[RoleController::class,'delete'])->name('role.delete');
        Route::get('/edit/{id}',[RoleController::class,'edit'])->name('role.edit');
        Route::post('/update',[RoleController::class,'update'])->name('role.update');
    });


});

Route::post('/success', 'App\Http\Controllers\Front\CheckoutControler@success')->name('success');

Route::post('/fail', 'CheckoutController@fail')->name('fail');
Route::get('/cancel', function(){
    return redirect()->to('/');
})->name('cancel');
