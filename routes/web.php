<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');
Route::get('/player/register', 'PlayersController@create')->name('player.register');
Route::post('/player/store', 'PlayersController@store')->name('player.store');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::post('approval/{id}', 'PlayersController@approval')->name('player.approval');

    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('players/destroy', 'PlayersController@massDestroy')->name('players.massDestroy');

    Route::resource('players', 'PlayersController');
    Route::resource('tournaments', 'TournamentsController');
});
