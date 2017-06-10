<?php

Route::group(['prefix' => 'SubModuleCode1'], function () {
 \MS\Core\B::r("Modules".DS."ModuleCode".DS."SubModuleCode1".DS."routes",false);
});

Route::group(['prefix' => 'SubModuleCode2'], function () {
 \MS\Core\B::r("Modules".DS."ModuleCode".DS."SubModuleCode2".DS."routes",false);
});