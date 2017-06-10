<?php


Route::group(['prefix' => 'Users'], function () {
 \MS\Core\B::r("Modules".DS."MS_Flex".DS."Users".DS."routes");
});

Route::group(['prefix' => 'Panel'], function () {
 \MS\Core\B::r("Modules".DS."MS_Flex".DS."Panel".DS."routes");
});
