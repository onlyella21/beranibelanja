<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;



// Route::get('/contact', function(){
    // function untuk menampillakn full url
    // request()->fullurl()
    //untuk menampilkan setelah '/' di domain kita 
    // request()->path()

   // return request()->path() =='contact' ? true : false;
// });

Route::get('search', 'App\Http\Controllers\SearchController@post')->name('search.posts');

Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts.index');
   

Route::prefix('posts')->middleware('auth')->group(function(){
    
    //route membuat dan menyimpan post
    Route::get('create','App\Http\Controllers\PostController@create')->name('posts.create');
    Route::post('store','App\Http\Controllers\PostController@store');
    //route untuk update (pake patch karena yg kita edit hanya sebagian, tidak edit id dan slug)
    Route::get('{post:slug}/edit','App\Http\Controllers\PostController@edit');
    Route::patch('{post:slug}/edit','App\Http\Controllers\PostController@update');
    Route::delete('{post:slug}/delete', 'App\Http\Controllers\PostController@destroy');
    
});

Route::get('/posts/{post:slug}', 'App\Http\Controllers\PostController@show')->name('posts.show');

Route::get('categories/{category:slug}','App\Http\Controllers\CategoryController@show')->name('categories.show');
Route::get('tags/{tag:slug}','App\Http\Controllers\TagController@show')->name('tags.show');





Route::view('contact', 'contact');
Route::view('about', 'about');
Route::view('login', 'login');
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
