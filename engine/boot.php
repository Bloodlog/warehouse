<?php

$libs = array(
			'core/auth/auth.php',
			'core/auth/permission.php',
		);
for ($i=0; $i < count($libs); $i++) { 
	require_once  $libs[$i];
}

/*
	include libs...
*/

require_once 'model/Model.php';
require_once 'view/View.php';
require_once 'controller/Controller.php';
require_once 'route.php';