<?php

Route::post('basket/solicitar', 'BasketController@solicitarMercadoPago');

Route::post('/basket/paymentResult', array('as' => 'basket.paymentResult', 'uses' => 'BasketController@paymentResult'));

Route::post('basket.add', 'BasketController@add');

Route::post('/basket/delete/item/{orderDetail_id}', array('as' => 'basket.delete.item', 'uses' => 'BasketController@destroyOrderDetail'));

Route::get('/basket/success', array('as' => 'basket.success', 'uses' => 'BasketController@success'));

Route::get('/basket/pending', array('as' => 'basket.pending', 'uses' => 'BasketController@pending'));

Route::get('/basket/failure', array('as' => 'basket.failure', 'uses' => 'BasketController@failure'));

Route::resource('basket', 'BasketController');
