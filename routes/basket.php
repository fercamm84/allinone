<?php

Route::post('basket.add', 'BasketController@add');

Route::post('/basket/delete/item/{orderDetail_id}', array('as' => 'basket.delete.item', 'uses' => 'BasketController@destroyOrderDetail'));

Route::resource('basket', 'BasketController');
