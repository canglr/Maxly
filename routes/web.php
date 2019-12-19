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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/{share_id}', 'HomeController@golink')->name('golink');

Route::get('/page/{title_sef}', 'HomeController@page')->name('page');

Route::post('/go/linkcreate', 'HomeController@linkcreate')->name('linkcreate');

Route::get('/go/mylinks', 'AccountController@mylinks')->name('mylinks');

Route::get('/go/mylinks/{id}/stats', 'AccountController@mylinks_stats')->name('mylinks-stats');

Route::get('/go/mylinks/{id}/hide', 'AccountController@mylinks_hide')->name('mylinks-hide');

Route::get('/go/myaccount', 'AccountController@myaccount')->name('myaccount');

Route::get('/go/myaccount/edit', 'AccountController@myaccount_edit')->name('myaccount-edit');

Route::post('/go/myaccount/edit', 'AccountController@myaccount_edit_post')->name('myaccount-edit-post');

Route::get('/go/myaccount/password', 'AccountController@myaccount_password')->name('myaccount-password');

Route::post('/go/myaccount/password', 'AccountController@myaccount_password_post')->name('myaccount-password-post');

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('dashboard');

Route::get('/admin/users', 'AdminController@users')->name('users');

Route::get('/admin/users/{id}/info', 'AdminController@users_info')->name('users-info');

Route::get('/admin/users/{id}/edit', 'AdminController@users_edit')->name('users-edit');

Route::post('/admin/users/{id}/edit', 'AdminController@users_edit_post')->name('users-edit-post');

Route::get('/admin/links', 'AdminController@links')->name('links');

Route::get('/admin/links/{id}/stats', 'AdminController@links_stats')->name('links-stats');

Route::get('/admin/links/{id}/delete', 'AdminController@links_delete')->name('links-delete');

Route::get('/admin/logs', 'AdminController@logs')->name('logs');

Route::get('/admin/pages', 'AdminController@pages')->name('pages');

Route::get('/admin/pages/new', 'AdminController@pages_new')->name('pages-new');

Route::post('/admin/pages/new', 'AdminController@pages_new_post')->name('pages-new-post');

Route::get('/admin/pages/{id}/edit', 'AdminController@pages_edit')->name('pages-edit');

Route::post('/admin/pages/{id}/edit', 'AdminController@pages_edit_post')->name('pages-edit-post');

Route::get('/admin/pages/{id}/delete', 'AdminController@pages_delete')->name('pages-delete');

Route::get('/admin/roles', 'AdminController@roles')->name('roles');

Route::post('/admin/roles', 'AdminController@roles_add')->name('roles-add');

Route::get('/admin/roles/{id}/delete', 'AdminController@roles_delete')->name('roles-delete');


