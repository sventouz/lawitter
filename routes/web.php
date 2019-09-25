<?php

// 名前を指定した Route の書き方
Route::get('about', 'PagesController@about')->name('about');
Route::get('contact', 'PagesController@contact')->name('contact');

Route::get('/', 'ArticlesController@index')->name('home');
Route::resource('articles', 'ArticlesController');

Auth::routes();
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::post('/articles/{id}/likes', 'LikesController@store');
Route::post('/articles/{id}/likes/{like}', 'LikesController@destroy');

// ログイン状態
Route::group(['middleware' => 'auth'], function() {
    // ユーザ関連
    // Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);
    // フォロー/フォロー解除を追加
    Route::post('/users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('/users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
});
