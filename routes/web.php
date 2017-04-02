<?php

Route::get('/', function() {
  return ('Welcome to Assignment 3');
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
