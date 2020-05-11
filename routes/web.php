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

// $client = new \GuzzleHttp\Client();
// $res = $client->request('GET', 'https://localhost:3001/recipes/');
// return view('recipes.index', json_decode( $res->getBody(), true));

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/recipes', function () {
    return view('recipes.index');
});

Route::get('/recipe/create', function () {
    return view('recipes.create');
});

Route::get('/recipe/edit/{uuid}', function ($uuid) {
    return view('recipes.edit', compact('uuid'));
});

Route::get('/recipe/{uuid}', function($uuid)
{
    return view('recipes.show', compact('uuid'));
});