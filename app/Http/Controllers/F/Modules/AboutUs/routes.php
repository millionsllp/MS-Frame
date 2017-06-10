<?php

Route::group(['prefix' => 'Structure'], function () {
 \MS\Core\B::r("Modules".DS."AboutUs".DS."Structure".DS."routes",false);
});

Route::group(['prefix' => 'Board_of_Directors'], function () {
 \MS\Core\B::r("Modules".DS."AboutUs".DS."Board_of_Directors".DS."routes",false);
});

Route::group(['prefix' => 'Objective'], function () {
 \MS\Core\B::r("Modules".DS."AboutUs".DS."Objective".DS."routes",false);
});

Route::group(['prefix' => 'Protocol'], function () {
 \MS\Core\B::r("Modules".DS."AboutUs".DS."Protocol".DS."routes",false);
});
Route::group(['prefix' => 'Massage'], function () {
 \MS\Core\B::r("Modules".DS."AboutUs".DS."Massage".DS."routes",false);
});