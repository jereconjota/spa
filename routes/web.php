<?php

Auth::routes(); 
Route::get('/{any}', 'HomeController@index')->where('any','.*'); //nos aseguramos que cualquier peticion a la ruta raiz sea redirigida al metodo index del homecontroller

