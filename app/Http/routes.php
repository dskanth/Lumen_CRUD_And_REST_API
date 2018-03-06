<?php

$app->get('/', function() use ($app) {
    return view('index'); //$app->welcome();
});

$app->post('/create-product', 'App\Http\Controllers\ProductController@store');

$app->get('/read-products', 'App\Http\Controllers\ProductController@index');

$app->get('/read-product/{id}', 'App\Http\Controllers\ProductController@show');

$app->post('/edit-product/{id}', 'App\Http\Controllers\ProductController@update');

$app->post('/delete-product', 'App\Http\Controllers\ProductController@destroy');