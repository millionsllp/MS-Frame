<?php


Route::group(['prefix' => 'CurrentBookVolume'], function () {
 \MS\Core\B::r("Modules".DS."FlexBox".DS."CurrentBookVolume".DS."routes");
});


Route::group(['prefix' => 'BoardOfDirectors'], function () {
 \MS\Core\B::r("Modules".DS."FlexBox".DS."BoardOfDirectors".DS."routes");
});

Route::group(['prefix' => 'BasicDetails'], function () {
 \MS\Core\B::r("Modules".DS."FlexBox".DS."BasicDetails".DS."routes");
});

