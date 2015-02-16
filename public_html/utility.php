<?php

$paths = parse_ini_file('../application/config/paths.ini.php', true);
define('__SITE_PATH', $paths['site_path']['site_path']);
define('__APPLICATION_PATH', $paths['include_paths']['application_path']);
define('__LIBRARY_PATH', $paths['include_paths']['library_path']);
define('__VIEW_PATH', $paths['include_paths']['application_path'].'view/');


function __autoload($class_name)
{
	$inc = null;
	require_once '../library/autoload.php';
	$inc = new autoload($class_name);
}

function printr($var, $text = null)
{
	if(empty($text)):
		$text = null;
	endif;

	echo '
	<style type = "text/css">
	<!--
	pre 	{ border: 1px solid #bbbbbb; background: #f0f0f0; font-family: Verdana; font-size: 10px; padding: 5px 10px 5px 10px; }
	h4 	{ font-size: 14px; margin: 5px 0px 5px 0px; }
	-->
	</style>';

	echo '<pre>';
	if(!empty($text)):
		echo "<h4>{$text}</h4>";
	endif;
	print_r($var);
	echo '</pre>';
}

function return_registry()
{
	global $registry;
	return $registry;
}