<?php

Route::post('/search/globalSearch', array('as' => 'search.globalSearch', 'uses' => 'SearchController@globalSearch'));
