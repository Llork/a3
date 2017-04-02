<?php

    /**
    * GET
    * /
    * use the index method of AnagramController:
    */
    Route::get('/', 'AnagramController@index');


    /**
    * GET
    * /anything...
    */
    Route::get('/{urlFolder?}', function($urlFolder = '') {
      return ('You typed ' . $urlFolder . ' after the domain name. Please remove this and use just the doman name to access Assignment 3. Thank you.');
    });

/*
Route::get('/', function () {
    return view('welcome');
});
*/

    /**
    * Log viewer
    * (only accessible locally)
    */
    if(config('app.env') == 'local') {
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    }

// closing php tag intentionally omitted
