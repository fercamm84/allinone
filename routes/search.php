<?php

Route::post('/search/globalSearch', array('as' => 'search.globalSearch', 'uses' => 'SearchController@globalSearch'));

Route::get('/search/sellerByLocation/{id}', 'SearchController@searchSellerByLocation');