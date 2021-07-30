<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* START SECTION THIRD PARTY INTEGRATION ROUTES */

Route::get('repositories/{code_repository}', 'RepositoryController@get')->name('repositories.providers.get');

/* START SECTION THIRD PARTY INTEGRATION ROUTES */
