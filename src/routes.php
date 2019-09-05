<?php

//dd(config('larapress'));

Route::get(config('larapress.route') . '/{id}', 'Jhalarde\Larapress\Http\Controllers\LarapressController@getPost');