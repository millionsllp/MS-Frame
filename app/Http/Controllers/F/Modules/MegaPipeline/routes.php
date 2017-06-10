<?php

Route::group(['prefix' => 'Area_Covered'], function () {
 \MS\Core\B::r("Modules".DS."MegaPipeline".DS."Area_Covered".DS."routes",false);
});

Route::group(['prefix' => 'Blue_Print'], function () {
 \MS\Core\B::r("Modules".DS."MegaPipeline".DS."Blue_Print".DS."routes",false);
});

Route::group(['prefix' => 'Current_Book_Volume'], function () {
 \MS\Core\B::r("Modules".DS."MegaPipeline".DS."Current_Book_Volume".DS."routes",false);
});