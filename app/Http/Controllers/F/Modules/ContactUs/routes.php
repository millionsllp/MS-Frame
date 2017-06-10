<?php

Route::group(['prefix' => 'Careers'], function () {
 \MS\Core\B::r("Modules".DS."ContactUs".DS."Careers".DS."routes",false);
});

Route::group(['prefix' => 'Contact_Details'], function () {
 \MS\Core\B::r("Modules".DS."ContactUs".DS."Contact_Details".DS."routes",false);
});

Route::group(['prefix' => 'Send_Query'], function () {
 \MS\Core\B::r("Modules".DS."ContactUs".DS."Send_Query".DS."routes",false);
});