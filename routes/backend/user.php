<?php

Route::get('/dashboard', 'UserDashboardController@index')->name('dashboard');



// Admin
Route::get('/profile', 'UserDashboardController@profile')->name('profile');
Route::get('/edit_profile', 'UserDashboardController@edit')->name('edit');
Route::patch('/edit_profile', 'UserDashboardController@update')->name('update');
Route::get('/change_password', 'UserDashboardController@change_password')->name('password_change');
Route::patch('/change_password', 'UserDashboardController@update_password')->name('change_password');

//end sector

//posts sector

Route::resource('posts', 'UserPostController');
Route::POST('posts/edit-post', 'UserPostController@editPost')->name('editPost');
Route::POST('posts/create-post', 'UserPostController@createPost')->name('createPost');
Route::get('/personal-posts', 'UserPostController@getAll')->name('personalPosts');

//end sector

Route::get('/public-profile/{userId}', 'UserCommonController@publicProfile')->name('publicProfile');
Route::get('/public-profile/{userId}/{page}', 'UserCommonController@publicProfileAndPostsPage')->name('publicProfileAndPostsPage');

Route::POST('/follow-on-user', 'UserCommonController@followOnUser')->name('followOnUser');
Route::POST('/unfollow-on-user', 'UserCommonController@unfollowOnUser')->name('unfollowOnUser');
Route::POST('/is-followed-on-user', 'UserCommonController@isFollowedOnUser')->name('isFollowedOnUser');
