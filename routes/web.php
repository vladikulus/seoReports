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

Route::get('/', [
    'as' => 'reports.create',
    'uses' => 'ReportController@index'
]);


Route::get('projects/metrics', [
    'as' => 'metrics',
    'uses' => 'ProjectsController@metricsList'
]);

Route::resource('projects', 'ProjectsController');

Route::post('create', [
    'as' => 'report_create',
    'uses' => 'ReportController@create'
]);

Route::post('get_auto_text', [
    'as' => 'get_auto_text',
    'uses' => 'ReportController@getAutoText'
]);

Route::post('generate_preview', [
    'as' => 'generate_preview',
    'uses' => 'ReportController@generatePreview'
]);

Route::get('oauth', [
    'as' => 'oauth',
    'uses' => 'OAuth@makeToken'
]);

Route::get('oauth/partner', [
    'as' => 'oauth.pertner',
    'uses' => 'OAuth@makePartnerToken'
]);

Route::get('oauth/seranking', [
    'as' => 'oauth.seranking',
    'uses' => 'OAuth@mekeSERankingToken'
]);

Route::get('chart', [
    'as' => 'chart',
    'uses' => 'ReportController@makeChart'
]);

