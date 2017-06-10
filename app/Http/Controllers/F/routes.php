<?php

Route::get('/','\FECM\Controller@index');
Route::get('/UnderContruction', '\FECM\Controller@underConstruction');


Route::group(['prefix' => 'mod'], function () {
 
});
\MS\Core\B::r("Modules".DS."routes",false);