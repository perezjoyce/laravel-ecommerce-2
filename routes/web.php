<?php
use App\Http\Controllers\ItemController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/catalog', 'ItemController@showItems');
Route::get("/menu/mycart", "ItemController@showCart")->middleware('isAdmin', 'auth'); 

Route::delete("/menu/clear_cart", "ItemController@clearCart");
Route::delete('/menu/mycart/{id}/delete_cart_item', "ItemController@deleteCartItem");
Route::patch('/menu/mycart/{id}/change_quantity', "ItemController@changeItemQuantity");
Route::get('/menu/{id}', 'ItemController@itemDetails');
Route::post("/add_to_cart/{id}", "ItemController@addToCart");

Route::group(['middleware' => ['auth']], function () {
    Route::get('/transaction_complete', "ItemController@checkout");
    Route::get('/orders', "ItemController@showOrders");
    Route::get("/menu/add", "ItemController@showAddItemForm");
    Route::post("/menu/add_item", "ItemController@saveNewItem");
    // Route::get("/checkout", "ItemController@checkout");
    Route::delete("/menu/{id}/delete_item", "ItemController@deleteItem");
    Route::get("/menu/{id}/edit_form", "ItemController@showEditForm");
    Route::patch("/menu/{id}/edit_item", "ItemController@editItem");
    Route::patch('/change_order_status/{id}', "ItemController@changeOrderStatus");
    Route::delete('/delete_order/{id}', 'ItemController@deleteOrder');
    Route::get('/restore_order/{id}', 'ItemController@restoreOrder');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
