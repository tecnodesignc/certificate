<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/certificate'], function (Router $router) {
    $router->get('generate', [
        'as' => 'certificate.generate',
        'uses' => 'PublicController@index',
        'middleware' => 'logged.in'
    ]);

    $router->post('generate/send', [
        'as' => 'certificate.generate.send',
        'uses' => 'PublicController@send',
        'middleware' => 'logged.in'
    ]);


    $router->get('show/{id}', [
        'as' => 'certificate.generate.show',
        'uses' => 'PublicController@show',
        'middleware' => 'logged.in'
    ]);

    $router->get('view/{key}/{id}', [
        'as' => 'certificate.generate.view',
        'uses' => 'PublicController@view',
    ]);

});
