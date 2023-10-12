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

use App\Models\Application;
use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => '/auth',
], function () use ($router) {
    $router->post('login', 'AuthController@login');
});

$router->group([
    'middleware' => 'auth',
], function () use ($router) {
    /*
     * Auth
     */
    $router->group([
        'prefix' => '/auth',
    ], function ($router) {
        $router->post('logout', 'AuthController@logout');
        $router->post('refresh', 'AuthController@refresh');
    });

    /*
     * Application
     */
    $router->group([
        'prefix' => '/applications',
    ], function ($router) {
        $router->get('/', 'ApplicationController@get');
        $router->post('/', 'ApplicationController@create');
        $router->patch('/{id}', 'ApplicationController@update');
        $router->delete('/{id}', 'ApplicationController@delete');
    });
});
