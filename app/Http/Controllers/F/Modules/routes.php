<?php

//////////////////////////////////////
//ModuleCode/////////////////////////
////////////////////////////////////

Route::group(['prefix' => 'AboutUs'], function () {
 \MS\Core\B::r("Modules".DS."AboutUs".DS."routes",false);
});


Route::group(['prefix' => 'ContactUs'], function () {
 \MS\Core\B::r("Modules".DS."ContactUs".DS."routes",false);
});


Route::group(['prefix' => 'MegaPipeline'], function () {
 \MS\Core\B::r("Modules".DS."MegaPipeline".DS."routes",false);
});


Route::group(['prefix' => 'News'], function () {
 \MS\Core\B::r("Modules".DS."News".DS."routes",false);
});
