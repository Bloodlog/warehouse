<?php

ini_set('display_errors', 1);

$appBase = dirname(__FILE__);



include($appBase.'/engine/config/config.php');

include($appBase.'/engine/boot.php');



Route::start(); // запускаем маршрутизатор