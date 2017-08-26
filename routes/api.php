<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Api\V1\Controllers'], function ($api) {
    $api->group(['prefix' => 'user'], function ($api) {
        $api->get('/', 'UserController@listUsers');
        $api->get('/{user_id}', 'UserController@getUser');
        $api->post('/', 'UserController@createUser');
        $api->match(['put', 'post'], '/{user_id}', 'UserController@updateUser');
        $api->delete('/{user_id}', 'UserController@deleteUser');
    });
});