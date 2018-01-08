<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', [
    	'as' => 'home',
    	'uses' => 'HomeController@index'
    ]);
    Route::get('/info', [
        'as' => 'info',
        'uses' => 'HomeController@info'
    ]);
});

Route::group(['middleware' => 'admin'], function () {
    /* article for admin*/
    Route::get('/articles', [
        'as' => 'articles',
        'uses' => 'ArticlesController@index'
    ]);
    Route::get('/article/{id}/{platform}/prewiew', [
        'as' => 'article.preview',
        'uses' => 'ArticlesController@preview'
    ])->where(array('id' => '[0-9]+', 'platform' => '[a-z]+'));
    Route::get('/article/create', [
        'as' => 'article.create',
        'uses' => 'ArticlesController@create'
    ]);
    Route::post('article/save', [
        'as' => 'article.save',
        'uses' => 'ArticlesController@save'
    ]);
    Route::get('/article/{id}/{platform}/edit', [
        'as' => 'article.edit',
        'uses' => 'ArticlesController@edit'
    ])->where(array('id' => '[0-9]+', 'platform' => '[a-z]+'));
    Route::put('/article/{id}/{platform}/update', [
        'as' => 'article.update',
        'uses' => 'ArticlesController@update'
    ])->where(array('id' => '[0-9]+', 'platform' => '[a-z]+'));
    /* end */
    Route::group(['prefix' => 'v1'], function () {
        Route::get('/articlesapi', [
            'as' => 'articlesapi',
            'uses' => 'ArticlesApiController@index'
        ]);
        Route::get('/articlesapi/{id}/{platform}', [
            'as' => 'articlesapi.show',
            'uses' => 'ArticlesApiController@show'
        ])->where(array('id' => '[0-9]+', 'platform' => '[a-z]+'));
        Route::put('/articlesapi/{id}/{platform}', [
            'as' => 'articlesapi.update',
            'uses' => 'ArticlesApiController@update'
        ])->where(array('id' => '[0-9]+', 'platform' => '[a-z]+'));
    });

    Route::group(['prefix' => 'frontend'], function () {
        Route::get('/articles', [
            'as' => 'frontend.articles',
            'uses' => 'FrontendArticlesApiController@index'
        ]);
        Route::get('/articles/edit', [
            'as' => 'frontend.articles.show',
            'uses' => 'FrontendArticlesApiController@show'
        ])->where(array('id' => '[0-9]+', 'platform' => '[a-z]+'));
    });
});

