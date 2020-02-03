<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/users','ExampleController@index' );
$router->get('/users/create','ExampleController@create' );
$router->post('/users','ExampleController@store');
$router->get('/users/{id}','ExampleController@show' );
$router->get('/users/{id}/edit','ExampleController@edit' );
$router->patch('/users/{id}','ExampleController@update' );
$router->delete('/users/{id}','ExampleController@destroy' );
