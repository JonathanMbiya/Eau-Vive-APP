<?php

// Initial setup

define('ROOT', __DIR__);

ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . ROOT);

function require_existing(string $path)
{
	file_exists($path) && require_once($path);
}

require_existing(ROOT . '/vendor/autoload.php');

// Programmatic router (can be replaced with anything you like)

$request = str_replace('%BASE%', '', $_SERVER['REQUEST_URI']);
if (substr($request, -1) === '/') {
	$request = substr($request, 0, strlen($request) - 1);
}

$indexFile = realpath("views/$request/index.php");
$namedFile = realpath("views/$request.php");

$error404 = realpath("views/404.php");

try {
	if (file_exists($indexFile)) {
		die(include($indexFile));
	} elseif (file_exists($namedFile)) {
		die(include($namedFile));
	}
	die(include($error404));
} catch (\Throwable $th) {
	die(include($error404));
}
