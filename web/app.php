<?php

use Symfony\Component\HttpFoundation\Request;

$env = isset($_SERVER['APP_ENV']) ? $_SERVER['APP_ENV'] : 'prod';
$debug = isset($_SERVER['APP_DEBUG']) ? (bool)$_SERVER['APP_DEBUG'] : false;
$cache = isset($_SERVER['APP_CACHE']) ? (bool)$_SERVER['APP_CACHE'] : true;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
if ($cache) {
    include_once __DIR__.'/../var/bootstrap.php.cache';
}

$kernel = new AppKernel($env, $debug);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
