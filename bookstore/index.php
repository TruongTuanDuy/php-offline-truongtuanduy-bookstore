<?php


require_once 'define.php';

error_reporting(E_ALL ^ E_NOTICE);

// function __autoload($clasName){
// 	require_once LIBRARY_PATH . "{$clasName}.php";
// }

spl_autoload_register(function ($className) {
	require_once LIBRARY_PATH . "{$className}.php";
});


Session::init();

$bootstrap = new Bootstrap();
$bootstrap->init();
