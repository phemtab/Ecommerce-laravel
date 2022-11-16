<?php


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

Route::get('/food', 'FoodController@loadMore');

Route::get('vote', 'VoteController@index');
Route::post('vote','VoteController@show')->name('votesystem.show');


Route::get('/products', 'ProductController@index');


//ส่วนของแสดงแยก Category
Route::get('/products/category/{id}', 'ProductController@showCategory');

//Route ทำงานรายละเอียดของสินค้า
Route::get('/products/details/{id}', 'ProductController@details');


//ทำเพื่อเวลา logout มันจะ redirect ไปหน้าแรกแต่จะไปที่ path product แทน
Route::get('/', function(){
    return redirect('/products');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/////////////////กรองด้วย Middleware เป็น Group /////////////////////////
Route::middleware(['auth','verifyIsAdmin'])->group(function() {

//ส่วนของ createProduct
Route::get('/admin/createProduct', 'Admin\ProductController@create');
Route::post('/admin/createProduct','Admin\ProductController@store')->name('addProduct');


//ส่วนของ createCategory
Route::get('/admin/createCategory', 'Admin\CategoryController@index');
Route::post('/admin/createCategory', 'Admin\CategoryController@store');
//ส่วนของ edit delete update Category
Route::get('/admin/editCategory/{id}', 'Admin\CategoryController@edit');
Route::post('/admin/updateCategory/{id}', 'Admin\CategoryController@update');
Route::get('/admin/deleteCategory/{id}', 'Admin\CategoryController@delete');

// ส่วนของ editProduct
Route::get('/admin/editProduct/{id}', 'Admin\ProductController@edit');
Route::get('/admin/editProductImage/{id}', 'Admin\ProductController@editImage');
Route::post('/admin/updateProduct/{id}', 'Admin\ProductController@update');
Route::post('/admin/updateProductImage/{id}', 'Admin\ProductController@updateImage');
Route::get('/admin/deleteProduct/{id}', 'Admin\ProductController@delete');

//ส่วนของ Dashboard
Route::get('/admin/dashboard/', 'Admin\ProductController@index');

//Order
Route::get('/admin/orders/', 'Admin\ProductController@orderPanel');
Route::get('/admin/orders/detail/{id}', 'Admin\ProductController@showOrderDetail');

//Payment
Route::get('/admin/payments','Admin\PaymentController@paymentsPanel');

Route::get('/admin/users','Admin\ProductController@showUsers');


});


//Middleware ตระกร้าสินค้า (Add to Cart) ต้อง login ก่อนถึง Add TO cart ได้
Route::middleware(['auth'])->group(function() {
    //Add to Cart
    Route::get('/products/addToCart/{id}', 'ProductController@addProductToCart');
    //เพิ่มจำนวนสินค้าเลยตอนกดซื้อ
    Route::post('/products/addQuantityToCart', 'ProductController@addQuantityToCart');

    //แสดง Cart
    Route::get('/products/cart', 'ProductController@showCart');
    
    //ลบสินค้า
    Route::get('/products/cart/deleteFromCart/{id}', 'ProductController@deleteFromCart');
    //เพิ่มจำนวนของสินค้าถ้ากดปุ่มบวก
    Route::get('/products/cart/incrementCart/{id}', 'ProductController@incrementCart');
    //ลดจำนวนสินค้าถ้ากดปุ่มลบ
    Route::get('/products/cart/decrementCart/{id}', 'ProductController@decrementCart');

    Route::get('/products/checkout','ProductController@checkout');
    Route::post('/products/createOrder','ProductController@createOrder');
    Route::get('/products/showPayment','ProductController@showPayment');
    //Payment
    Route::get('/paymentreciept/{paypalOrderID}/{payerID}','PaymentController@showPayment');



});
    //ช่องค้นหา
Route::get('/products/search', 'ProductController@searchProduct');
//ค้นหาด้วยราคา
Route::get('/products/priceRange', 'ProductController@searchProductPrice');




