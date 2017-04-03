<?php

    /**
    * GET
    * /
    * use the rearrange method of AnagramController:
    */
    Route::get('/', 'AnagramController@rearrange');


    /**
    * Log viewer
    * (only accessible locally)
    */
    if(config('app.env') == 'local') {
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    }


    /**
    * GET
    * /anything else...
    */
    Route::get('/{urlFolder?}', function($urlFolder = '') {
      return ('You typed "' . $urlFolder . '" after the domain name. Please remove this and use just the domain name to access Assignment 3. Thank you.');
    });


/*
Route::get('/', function () {
    return view('welcome');
});
*/

// closing php tag intentionally omitted
