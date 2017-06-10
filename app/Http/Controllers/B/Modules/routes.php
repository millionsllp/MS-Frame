<?php


Route::group(['prefix' => 'MS_Flex'], function () {
 \MS\Core\B::r("Modules".DS."MS_Flex".DS."routes");
});

Route::group(['prefix' => 'News'], function () {
 \MS\Core\B::r("Modules".DS."News".DS."routes");
});

Route::group(['prefix' => 'Announcements'], function () {
 \MS\Core\B::r("Modules".DS."Announcements".DS."routes");
});



Route::group(['prefix' => 'FlexBox'], function () {
 \MS\Core\B::r("Modules".DS."FlexBox".DS."routes");
});
