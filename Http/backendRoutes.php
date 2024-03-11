<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/certificate'], function (Router $router) {
    $router->bind('document', function ($id) {
        return app('Modules\Certificate\Repositories\DocumentRepository')->find($id);
    });
    $router->get('documents', [
        'as' => 'admin.certificate.document.index',
        'uses' => 'DocumentController@index',
        'middleware' => 'can:certificate.documents.index'
    ]);
    $router->get('documents/create', [
        'as' => 'admin.certificate.document.create',
        'uses' => 'DocumentController@create',
        'middleware' => 'can:certificate.documents.create'
    ]);
    $router->post('documents', [
        'as' => 'admin.certificate.document.store',
        'uses' => 'DocumentController@store',
        'middleware' => 'can:certificate.documents.create'
    ]);
    $router->get('documents/{document}/edit', [
        'as' => 'admin.certificate.document.edit',
        'uses' => 'DocumentController@edit',
        'middleware' => 'can:certificate.documents.edit'
    ]);
    $router->put('documents/{document}', [
        'as' => 'admin.certificate.document.update',
        'uses' => 'DocumentController@update',
        'middleware' => 'can:certificate.documents.edit'
    ]);
    $router->delete('documents/{document}', [
        'as' => 'admin.certificate.document.destroy',
        'uses' => 'DocumentController@destroy',
        'middleware' => 'can:certificate.documents.destroy'
    ]);
    $router->bind('config', function ($id) {
        return app('Modules\Certificate\Repositories\ConfigRepository')->find($id);
    });
    $router->get('configs', [
        'as' => 'admin.certificate.config.index',
        'uses' => 'ConfigController@index',
        'middleware' => 'can:certificate.configs.index'
    ]);
    $router->get('configs/create', [
        'as' => 'admin.certificate.config.create',
        'uses' => 'ConfigController@create',
        'middleware' => 'can:certificate.configs.create'
    ]);
    $router->post('configs', [
        'as' => 'admin.certificate.config.store',
        'uses' => 'ConfigController@store',
        'middleware' => 'can:certificate.configs.create'
    ]);
    $router->get('configs/{config}/edit', [
        'as' => 'admin.certificate.config.edit',
        'uses' => 'ConfigController@edit',
        'middleware' => 'can:certificate.configs.edit'
    ]);
    $router->put('configs/{config}', [
        'as' => 'admin.certificate.config.update',
        'uses' => 'ConfigController@update',
        'middleware' => 'can:certificate.configs.edit'
    ]);
    $router->delete('configs/{config}', [
        'as' => 'admin.certificate.config.destroy',
        'uses' => 'ConfigController@destroy',
        'middleware' => 'can:certificate.configs.destroy'
    ]);
// append


});
