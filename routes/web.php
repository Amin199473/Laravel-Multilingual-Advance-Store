<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Backend\AdminOrderController;
use App\Http\Controllers\Frontend\FrontHomeController;
use App\Http\Controllers\Backend\ReturnOrderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\ApproveReviewController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ShippingArea\ManageStateController;
use App\Http\Controllers\Backend\ShippingArea\ManageDistrictController;
use App\Http\Controllers\Backend\ShippingArea\ManageDivisionController;
use App\Http\Controllers\Frontend\ProductController as ProductFrontController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//multiple Auth routes for Admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

//Admin Routes
Route::prefix('admin')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');
        Route::get('/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
        Route::get('/profile/edit/{id}', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
        Route::post('/profile/update/{id}', [AdminProfileController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
        Route::get('/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
        Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

        //admin brand route
        Route::resource('/brand', BrandController::class);

        //admin Category Route
        Route::resource('/category', CategoryController::class);

        //admin subCategory Route
        Route::resource('/subcategory', SubCategoryController::class);

        //admin subsubCategory Route
        Route::resource('/subsubcategory', SubSubCategoryController::class);

        //admin Prouct Route
        Route::resource('/product', ProductController::class);
        Route::post('/deleteProducImages', [ProductController::class, 'UpdateProducImages'])->name('update.produc.images');
        Route::get('/deleteProducImage/{id}', [ProductController::class, 'DeleteProducImage'])->name('delete.product.image');
        Route::get('/product-Inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
        Route::get('/product-Active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
        //Ajax request Route
        Route::get('/getSubSubCategory', [ProductController::class, 'GetSubSubCategory'])->name('getSubSubCategory');

        //admin slider Route
        Route::resource('/slider', SliderController::class)->except(['create', 'show']);
        Route::get('/InactiveSlider/{id}', [SliderController::class, 'InActiveSlider'])->name('slider.inactive');
        Route::get('/ActiveSlider/{id}', [SliderController::class, 'ActiveSlider'])->name('slider.active');

        //Admin coupon Routes
        Route::resource('/coupon', CouponController::class)->except(['create', 'show']);
        Route::get('/coupon/active/{id}', [CouponController::class, 'CouponActive'])->name('coupon.active');
        Route::get('/coupon/inactive/{id}', [CouponController::class, 'CouponInactive'])->name('coupon.inactive');

        //Shipping  Area Routes
        Route::prefix('/shipping')->group(function () {
            Route::resource('/manageDivision', ManageDivisionController::class)->except(['create', 'show']);
            Route::resource('/manageDistrict', ManageDistrictController::class)->except(['create', 'show']);
            Route::resource('/manageState', ManageStateController::class)->except(['create', 'show']);
            Route::get('/getDistricts', [ManageStateController::class, 'GetDistricts'])->name('get.districts');
            Route::get('/getStates', [ManageStateController::class, 'GetStates'])->name('get.states');
        });

        //Admin ordere management routes
        route::get('/pending/orders', [AdminOrderController::class, 'PendingOrders'])->name('pendingOrders');
        route::get('/pending/order/details/{id}', [AdminOrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');
        route::get('/confirmed/orders', [AdminOrderController::class, 'ConfirmedOrders'])->name('confirmedOrders');
        route::get('/processing/orders', [AdminOrderController::class, 'ProcessingOrders'])->name('processingOrders');
        route::get('/picked/orders', [AdminOrderController::class, 'PickedOrders'])->name('pickedOrders');
        route::get('/shipped/orders', [AdminOrderController::class, 'ShippedOrders'])->name('shippedOrders');
        route::get('/delivered/orders', [AdminOrderController::class, 'DeliveredOrders'])->name('deliveredOrders');
        route::get('/canceled/orders', [AdminOrderController::class, 'CanceledOrders'])->name('canceledOrders');
        //update order status
        route::get('/pendingToConfirmed/{id}', [AdminOrderController::class, 'PendingToConfirmed'])->name('pending.to.confirmed');
        route::get('/ConfirmedToProcessing/{id}', [AdminOrderController::class, 'ConfirmedToProcessing'])->name('confirmed.to.processing');
        route::get('/ProcessingToPicked/{id}', [AdminOrderController::class, 'ProcessingToPicked'])->name('processing.to.picked');
        route::get('/PickedToShipped/{id}', [AdminOrderController::class, 'PickedToShipped'])->name('picked.to.shipped');
        route::get('/ShippedToDelivered/{id}', [AdminOrderController::class, 'ShippedToDelivered'])->name('shipped.to.delivered');
        route::get('/DeliveredToCanceled/{id}', [AdminOrderController::class, 'DeliveredToCanceled'])->name('delivered.to.canceled');
        route::get('/Invoice/Download/{id}', [AdminOrderController::class, 'AdminInvoiceDownload'])->name('admin.invoice.download');

        // Admin Report routes
        Route::prefix('/reports')->group(function () {
            Route::get('/view', [ReportController::class, 'ReportView'])->name('report.view');
            Route::post('/search/date', [ReportController::class, 'ReportByDate'])->name('search.by.date');
            Route::post('/search/month', [ReportController::class, 'ReportByMonth'])->name('search.by.month');
            Route::post('/search/year', [ReportController::class, 'ReportByYear'])->name('search.by.year');
        });

        //Admin User Routes
        Route::prefix('/users')->group(function () {
            Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all.users');
        });


        //Admin Blog Routes
        Route::prefix('/blog')->group(function () {
            Route::resource('/postCategory', PostCategoryController::class);
            Route::resource('/post', PostController::class);
        });


        //Admin  Site Setting Routes
        Route::prefix('/setting')->group(function () {
            Route::get('/site', [SettingController::class, 'SiteSetting'])->name('site.setting');
            Route::post('/update/site/setting', [SettingController::class, 'UpdateSiteSetting'])->name('update.site.setting');

            Route::get('/seo', [SettingController::class, 'SeoSetting'])->name('seo.setting');
            Route::post('/update/seo/setting', [SettingController::class, 'UpdateSeoSetting'])->name('update.seo.setting');
        });

        //admin return orders routes
        Route::prefix('/return')->group(function () {
            Route::get('/order/request', [ReturnOrderController::class, 'ReturnOrder'])->name('admin.return.order');
            Route::get('/order/approve/{id}', [ReturnOrderController::class, 'ReturnOrderApprove'])->name('return.order.approve');
            Route::get('/All/orders/', [ReturnOrderController::class, 'ReturnAllOrders'])->name('return.all.orders');
        });

        // admin reivew routes
        Route::prefix('/review')->group(function () {
            Route::get('/pending/approve', [ApproveReviewController::class, 'PendingReview'])->name('pending.approve');
            Route::get('/approved/store/{id}', [ApproveReviewController::class, 'ApprovedStore'])->name('approved.store');
            Route::get('/approved/reviews', [ApproveReviewController::class, 'ApprovedReviews'])->name('approved.reviews');
            Route::delete('/review/delete/{id}', [ApproveReviewController::class, 'ReviewDelete'])->name('review.delete');
        });

        // admin reivew routes
        Route::prefix('/stock')->group(function () {
            Route::get('/product',[ProductController::class,'ProductStock'])->name('product.stock');
        });
    });
});









Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard')->middleware('auth:admin');

// User dashboard route
Route::middleware(['auth:sanctum,web', 'verified', 'user'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [FrontHomeController::class, 'index'])->name('home.index');
Route::get('/user/logout', [FrontHomeController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/Profile', [FrontHomeController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/Profile/edit/{id}', [FrontHomeController::class, 'UserProfileEdit'])->name('user.profile.edit');
Route::get('/user/Change/password', [FrontHomeController::class, 'UserChangePassword'])->name('user.change.password');
Route::post('/user/update/password', [FrontHomeController::class, 'UserUpdatePassword'])->name('user.update.password');
Route::get('/posts/', [FrontHomeController::class, 'Posts'])->name('home.posts');
Route::get('/post/detail/{id}/{slug}', [FrontHomeController::class, 'PostDetail'])->name('post.detail');
Route::get('/blog/category/post/{id}', [FrontHomeController::class, 'PostFindByCategory'])->name('category.post');


//Language route
Route::get('/PersianLanguage', [LanguageController::class, 'Persian'])->name('persian.language');
Route::get('/EnglishLanguage', [LanguageController::class, 'English'])->name('english.language');

// product deatails
Route::get('/product/details/{slug}/{id}', [ProductFrontController::class, 'ProductDetails'])->name('product.details');


//product tags
Route::get('/product/tag/{tag}', [ProductFrontController::class, 'TagWiseProduct'])->name('product.tag');


//subcategory wise data
Route::get('/subcategory/products/{id}/{slug}', [ProductFrontController::class, 'SubCategoryProducts'])->name('subcategory.products');
//subsubcategory wise data
Route::get('/subsubcategory/products/{id}/{slug}', [ProductFrontController::class, 'SubSubCategoryProducts'])->name('subsubcategory.products');


//Product view Modal With Ajax Request
Route::get('/product/view/modal/{id}', [ProductFrontController::class, 'ProductViewModal'])->name('product.view.modal');


//Add To Cart AJax request
Route::post('/addToCart/store/{id}', [CartController::class, 'AddToCart'])->name('addToCart');

//update mini cart with Ajax request
Route::get('/product/mini/cart', [CartController::class, 'MiniCart'])->name('mini.cart');

//remove mini cart with Ajax request
Route::get('/miniCart/product/remove/{rowId}', [CartController::class, 'MiniCartRemove'])->name('mini.cart.remove');

// protect wishlist routes  by middleware
Route::middleware(['user', 'auth'])->group(function () {
    //Add product To wishlist Ajax Request
    Route::get('/Mywishlist/products', [WishlistController::class, 'ShowWishlistProduct'])->name('mywishlist.products');
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'WishlistRemove'])->name('wishlist.remove');
    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
    Route::post('/stripe/order', [CashController::class, 'CashOrder'])->name('cash.order');

    // all user routes raleted to user account
    Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');
    Route::get('/my/order/details/{id}', [AllUserController::class, 'MyOrderDetails'])->name('my.order.details');
    Route::get('/user/invoice/download/{id}', [AllUserController::class, 'InvoiceDownload'])->name('user.invoice.download');
    Route::post('/user/return/order/{id}', [AllUserController::class, 'OrderReturnReason'])->name('return.order');
    Route::get('/return/order/list/', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');
    Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');

    Route::post('/order/tracking', [AllUserController::class, 'OrderTracking'])->name('order.tracking');
});
Route::post('/addTo-Wishlist/{product_id}', [WishlistController::class, 'AddToWishlist'])->name('addToWishlist');


Route::get('/myCart', [CartPageController::class, 'MyCartPage'])->name('myCart');
//update qty with Ajax
Route::post('/cart/qty/update/{id}', [CartPageController::class, 'UpdateCartQty'])->name('cart.qty.update');


//Apply Coupon
Route::post('/couponApply', [CartController::class, 'ApplyCoupon'])->name('apply.coupon');
Route::get('/couponCalculation', [CartController::class, 'CouponCalculation'])->name('coupon.calculation');
Route::get('/couponRemove', [CartController::class, 'CouponRemove'])->name('coupon.remove');
Route::get('/checkout', [CheckoutController::class, 'CheckoutCreate'])->name('checkout');
Route::post('/checkoutStore', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

//Review product routes
Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');



// search product routes
Route::post('/product/search/',[FrontHomeController::class,'ProductSearch'])->name('product.search');


//search by Ajax
Route::post('/advance/search/',[FrontHomeController::class,'AdvanceSearch'])->name('product.advanceSearch');
