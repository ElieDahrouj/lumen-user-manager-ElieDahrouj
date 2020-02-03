<?php
$router->get('/api/users','api\ApiController@index');
$router->post('/api/users/create','api\ApiController@store');
$router->get('/api/users/{id}','api\ApiController@show');
$router->patch('/api/users/{id}','api\ApiController@update');
$router->delete('/api/users/{id}','api\ApiController@destroy');