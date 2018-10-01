<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('home', function(){
    return view('home');
});

Route::get('/', function(){
    return view('login');
});


Route::get('tables', function(){
    return view('table');
});

Route::get('forms', function(){
    return view('form');
});


Route::get('charts', function(){
    return view('mcharts');
});

Route::get('blank', function(){
    return view('blank');
});

Route::get('panel', function(){
    return view('panel');
});

Route::get('collapse', function(){
    return view('collapse');
});

Route::get('documentation', function(){
    return view('documentation');
});

Route::get('icons', function(){
    return view('icons');
});

Route::get('notifications', function(){
    return view('notifications');
});

Route::get('panels', function(){
    return view('panel');
});

// Route::get('', function(){
//     return view('progressbars');
// });

Route::get('stats', function(){
    return view('stats');
});

Route::get('typography', function(){
    return view('typography');
});

Route::get('buttons', function(){
    return view('buttons');
});

Route::get('grid', function(){
    return view('grid');
});


Route::get('admin', function(){
    return view('layouts.dashboardAdmin');
});



