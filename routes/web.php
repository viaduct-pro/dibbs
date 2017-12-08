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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('ico-item/{slug?}', ['as' => 'item', 'uses' => 'Site\ItemController@getItem']);
Route::post('ico-item/{id?}', ['as' => 'front-item-edit', 'uses' => 'Site\ItemController@getItemSave']);
Route::get('ajax-items', ['as' => 'ajax-items', 'uses' => 'Site\ItemController@getItemsAjax']);
Route::get('ajax-coins/{term?}', ['as' => 'ajax-items-list', 'uses' => 'Site\ItemController@getCoinsAjaxAll']);
Route::get('/coins', ['as' => 'coins-front', 'uses' => 'HomeController@getCoins']);

Route::get('/parse', ['as' => 'coins-parse', 'uses' => 'HomeController@parseCoins']);
Route::get('/check', ['as' => 'coins-check', 'uses' => 'HomeController@ICOCheck']);
Route::get('/coin/{id?}', ['as' => 'coin-front', 'uses' => 'Admin\DashboardController@coin']);
Route::get('/coin-ajax/{id?}', ['as' => 'coin-ajax', 'uses' => 'HomeController@getCoinAjax']);
Route::get('comment/{id?}', ['as' => 'comment', 'uses' => 'Site\CommentController@getComment']);
Route::get('/rating/vote', 'Site\RatingController@vote');

Route::get('finished_ico', ['as' => 'getico', 'uses' => 'Site\ItemController@getFinished']);


//Route::group(['prefix'=>'like', 'middleware' => 'web'], function (){
//    Route::group(['middleware' => 'auth'], function (){
//        Route::get('/vote', 'Site\LikeController@vote');
//    });
//});
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', ['as' => 'admin', 'uses' => 'Admin\DashboardController@index']);
    Route::get('/manage', ['middleware' => 'auth', 'uses' => 'AdminController@manageAdmins']);
    Route::get('/real-coins', ['as' => 'real-coins', 'uses' => 'Admin\DashboardController@coins']);

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['as' => 'users', 'uses' => 'Admin\UserController@index']);
        Route::get('user/{id?}', ['as' => 'user-edit', 'uses' => 'Admin\UserController@getUser']);
        Route::post('user/{id?}', ['as' => 'user-edit', 'uses' => 'Admin\UserController@getUserSave']);
        Route::get('user/{id}/delete', ['as' => 'user-delete', 'uses' => 'Admin\UserController@deleteUser']);
        Route::post('user/{id}/image/upload', ['as' => 'user-image-upload', 'uses' => 'Admin\UserController@uploadUserImage']);
    });

    Route::group(['prefix' => 'items'], function () {
        Route::get('/', ['as' => 'items', 'uses' => 'Admin\ItemController@getItems']);
        Route::get('item/{id?}', ['as' => 'item-edit', 'uses' => 'Admin\ItemController@getItemEdit']);
        Route::post('item/{id?}', ['as' => 'item-edit', 'uses' => 'Admin\ItemController@getItemSave']);
        Route::get('item/publish/{id?}', ['as' => 'item-publish', 'uses' => 'Admin\ItemController@getItemPublish']);
        Route::get('item/unpublish/{id?}', ['as' => 'item-unpublish', 'uses' => 'Admin\ItemController@getItemUnpublish']);
        Route::get('item/{id}/delete', ['as' => 'item-delete', 'uses' => 'Admin\ItemController@deleteItem']);
        Route::post('item/{id}/image/upload', ['as' => 'item-image-upload', 'uses' => 'Admin\ItemController@uploadItemImage']);
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', ['as' => 'comments', 'uses' => 'Admin\CommentController@getComments']);
        Route::get('comment/{id?}', ['as' => 'comment-edit', 'uses' => 'Admin\CommentController@getCommentEdit']);
        Route::post('comment/{id?}', ['as' => 'comment-edit', 'uses' => 'Admin\CommentController@getCommentSave']);
        Route::get('comment/{id}/delete', ['as' => 'comment-delete', 'uses' => 'Admin\CommentController@deleteComment']);
    });

    Route::group(['prefix' => 'configs'], function () {
        Route::get('/', ['as' => 'configs', 'uses' => 'Admin\ConfigController@getItems']);
        Route::get('config/{id?}', ['as' => 'config-edit', 'uses' => 'Admin\ConfigController@getItemEdit']);
        Route::post('config/{id?}', ['as' => 'config-edit', 'uses' => 'Admin\ConfigController@getItemSave']);
        Route::get('config/{id}/delete', ['as' => 'config-delete', 'uses' => 'Admin\ConfigController@deleteItem']);
    });

    Route::group(['prefix' => 'coins'], function () {
        Route::get('/', ['as' => 'coins', 'uses' => 'Admin\CoinController@getCoins']);
        Route::get('coin/{id?}', ['as' => 'coin-edit', 'uses' => 'Admin\CoinController@getCoinEdit']);
        Route::post('coin/{id?}', ['as' => 'coin-edit', 'uses' => 'Admin\CoinController@getCoinSave']);
        Route::get('coin/{id}/delete', ['as' => 'coin-delete', 'uses' => 'Admin\CoinController@deleteCoin']);
        Route::post('coin/{id}/image/upload', ['as' => 'coin-image-upload', 'uses' => 'Admin\CoinController@uploadCoinImage']);
    });

    /*Photo*/
    Route::post('photo/delete/{id}', ['as' => 'photo-delete', 'uses' => 'Admin\PhotoController@deletePhoto']);
});