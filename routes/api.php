<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function(){
    Route::apiResource('/articles', 'ArticleController');
    Route::get('/my_articles', 'ArticleController@myArticles');
});
