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

Route::get('/', 'postsController@userHome');
Route::get('/posts/{id}', 'postsController@show');
Route::get('/categories/{id}', 'categoriesController@show');

Route::get('/dashboard', function () {
    $numberOfPosts      = App\post::count();
    $numberOfCategories = App\category::count();
    return view('dashboard.index' , ['posts'=>$numberOfPosts ,'categories'=>$numberOfCategories]);
});

Route::resource('/dashboard/categories' , 'categoriesController');
Route::resource('/dashboard/posts' , 'postsController');


