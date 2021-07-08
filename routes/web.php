<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return $router->app->version();
});

$router->post('login', ['uses' => 'AuthController@login']);

$router->group(['middleware' => 'auth', 'prefix' => 'api'], function () use ($router) {

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('logout', ['uses' => 'AuthController@logout']);
        $router->post('refresh', ['uses' => 'AuthController@refresh']);
        $router->post('me', ['uses' => 'AuthController@me']);
    });

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', ['uses' => 'UserController@index']);
        $router->get('/{id}', ['uses' => 'UserController@show']);
        $router->post('/', ['uses' => 'UserController@create']);
        $router->put('/{id}', ['uses' => 'UserController@update']);
        $router->delete('/{id}', ['uses' => 'UserController@destroy']);
    });
});
