<?php

Route::get('calculator', function(){
	echo 'Hello from the calculator package!';
});

Route::get('add/{a}/{b}', 'Calci\Calculator\CalculatorController@add');
Route::get('subtract/{a}/{b}', 'Calci\Calculator\CalculatorController@subtract');