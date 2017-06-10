<?php

Route::group(['prefix' => 'Latest_Update'], function () {
 \MS\Core\B::r("Modules".DS."News".DS."LatestUpdate".DS."routes",false);
});


Route::group(['prefix' => 'Announcements'], function () {
 \MS\Core\B::r("Modules".DS."News".DS."Announcements".DS."routes",false);
});

