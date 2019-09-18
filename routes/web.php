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

$router->get('/', function () use ($router) {
    return 'Welcome';
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register',  ['uses' => 'Auth\RegisterController@register']);
    $router->post('login',  ['uses' => 'Auth\LoginController@index']);

    $router->get('/test', function () use ($router) {
        return 'Test';
    });
    $router->group(['middleware' => 'client'], function () use ($router) {
        $router->get('user/{id}','UserController@index');
    });
});


