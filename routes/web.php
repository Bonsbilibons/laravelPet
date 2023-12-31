<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'error.'
    ],
    function ()
    {
    Route::get('error', 'ErrorController@error')->name('common.error');
    }
);

Route::group([
    'as' => 'main.',
//    'middleware' => 'custom.auth:user'
    'middleware' => ['auth:user', 'blacklist'],
    ],
    function ()
    {
        Route::get('main', 'MainController@mainPage')->name('main_page');
        Route::get('main/{pageId}', 'MainController@mainPageById')->name('main.page.id');
        Route::get('main/getAllActive', 'MainController@getAllActive')->name('main.getAllActive');
        Route::get('main/{category}/{pageId}', 'MainController@mainByCategoryAndPageID')->name('main.page.category.id');
    }
);

Route::group([
    'as' => 'post.',
//    'middleware' => 'custom.auth:user'
    'middleware' => 'auth:user',
],
    function () {
        Route::get('post/{id}', 'PostController@postById')->name('post.by.id');
        Route::post('post/leave-comment', 'PostController@leaveComment')->name('leaveComment');
        Route::post('post/like-post', 'PostController@likePost')->name('likePost');
        Route::post('post/dislike-post', 'PostController@dislikePost')->name('dislikePost');
        Route::post('post/is-post-liked', 'PostController@isPostLiked')->name('isPostLiked');
    }
);

Route::group([
    'namespace' => 'Frontend',
    'as' => 'frontend.'],
    function () {
        require base_path('routes/frontend/frontend.php');
    });


// Bakcend


// Admin Auth
Route::prefix('admin_login')->group(function () {
    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
    Route::get('logout', 'Auth\Admin\LoginController@logout');
});

// Admin Dashborad
Route::group([
    'namespace' => 'Backend\Admin',
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'auth:admin'],
    function () {
        require base_path('routes/backend/admin.php');
    });

// User Auth
Route::prefix('user_login')->group(function () {
    Route::get('login', 'Auth\User\LoginController@login')->name('user.auth.login');
    Route::post('login', 'Auth\User\LoginController@loginUser')->name('user.auth.loginUser');
    Route::post('logout', 'Auth\User\LoginController@logout')->name('user.auth.logout');
    Route::get('logout', 'Auth\User\LoginController@logout');
});

// User Dashborad
Route::group([
    'namespace' => 'Backend\User',
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => 'auth:user'],
    function () {
        require base_path('routes/backend/user.php');
    });

// clear config and cache
//['cache:clear', 'optimize', 'route:cache', 'route:clear', 'view:clear', 'config:cache']

//    /artisan/cache-clear  // replace (:) to (-)
//Route::get('/artisan/{cmd}', function($cmd) {
//   $cmd = trim(str_replace("-",":", $cmd));
//   $validCommands = ['cache:clear', 'optimize', 'route:cache', 'route:clear', 'view:clear', 'config:cache'];
//   if (in_array($cmd, $validCommands)) {
//      Artisan::call($cmd);
//      return "<h1>Ran Artisan command: {$cmd}</h1>";
//   } else {
//      return "<h1>Not valid Artisan command</h1>";
//   }
//});

//Route::get('fire', function () {
//    event(new App\Events\LikeEvent());
//    return "event fired";
//});
