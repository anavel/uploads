<?php

Route::group(
    [
        'prefix' => 'uploads',
        'namespace' => 'Anavel\Uploads\Http\Controllers'
    ],
    function () {
        Route::get('/', [
            'as'   => 'anavel-uploads.list',
            'uses' => 'MainController@index'
        ]);

        Route::post('create-dir', [
            'as'   => 'anavel-uploads.create-dir',
            'uses' => 'MainController@createDirectory'
        ]);

        Route::delete('dir/{name}', [
            'as'   => 'anavel-uploads.destroy-dir',
            'uses' => 'MainController@destroyDirectory'
        ]);

        Route::post('upload', [
            'as'   => 'anavel-uploads.upload-file',
            'uses' => 'MainController@upload'
        ]);

        Route::delete('file/{name}', [
            'as'   => 'anavel-uploads.destroy-file',
            'uses' => 'MainController@destroyFile'
        ]);
    }
);
