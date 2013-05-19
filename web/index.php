<?php
define('DS', DIRECTORY_SEPARATOR);
define('APPROOT', dirname(__FILE__) . DS);
define('VIEWROOT', APPROOT . 'views' . DS);

error_reporting(E_ALL);

require APPROOT . 'inc' . DS. 'subs.common.php';
require APPROOT . 'vendor' . DS . 'ClassLoader.php';

$classLoader = new ClassLoader;
$classLoader->add('src', APPROOT . 'src');
$classLoader->register();

ob_start();

$actionName = actionClass();

$c = new $actionName;
$c->executeAction();