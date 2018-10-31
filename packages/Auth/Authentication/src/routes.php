<?php

Route::post('login','Auth\Authentication\UsersController@login');
Route::post('register','Auth\Authentication\UsersController@register');

