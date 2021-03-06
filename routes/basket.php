<?php

//Route::post('/basket/solicitar', 'BasketController@solicitarMercadoPago');

Route::post('/basket/solicitar', array('as' => 'basket.solicitar', 'uses' => 'BasketController@solicitarMercadoPago'));

Route::post('/basket/paymentResult', array('as' => 'basket.paymentResult', 'uses' => 'BasketController@paymentResult'));

Route::post('basket.add', 'BasketController@add');

Route::post('/basket/delete/item/{orderDetail_id}', array('as' => 'basket.delete.item', 'uses' => 'BasketController@destroyOrderDetail'));

Route::get('/basket/success', array('as' => 'basket.success', 'uses' => 'BasketController@success'));

Route::get('/basket/pending', array('as' => 'basket.pending', 'uses' => 'BasketController@pending'));

Route::get('/basket/failure', array('as' => 'basket.failure', 'uses' => 'BasketController@failure'));

Route::get('/basket/history', array('as' => 'basket.history', 'uses' => 'BasketController@history'));

Route::resource('basket', 'BasketController');

Route::post('prueba', 'BasketController@prueba');

//Route::post('/basket/solicitar', function () {
//    return response('<meta name="csrf-token" content="{{ csrf_token() }}">', 200)
//        ->header('Content-Type', 'text/plain');
//});
