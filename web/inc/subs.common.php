<?php

function exception_handler(Exception $e)
{
	ob_get_level() AND ob_clean ();

	require APPROOT . 'views/global-error.php';
}

function error_handler($code, $error, $file = NULL, $line = NULL)
{
	if (error_reporting() & $code)
	{
		throw new ErrorException($error, $code, 0, $file, $line);
	}

	// Do not execute the PHP error handler
	return TRUE;
}

set_exception_handler('exception_handler');
set_error_handler('error_handler');

function dbg()
{
	exit(strtr('<pre>:text</pre>', array(
		':text' => print_r(func_get_args(), TRUE),
	)));
}

function actionClass()
{
	$a = isset($_GET['a']) ? 'Action_' . ucfirst($_GET['a']) : 'Action_Index';
	$a = str_replace('.', '_', $a);
	$aRaw = explode('_', $a);
	$a = array();
	
	foreach($aRaw as $part)
	{
		$a[]= ucfirst($part);
	}

	$className = implode('_', $a);

	if (class_exists($className))
		return $className;

	return 'Action_404';
}

function text_strlen($text)
{
	if (function_exists('mb_strlen'))
	{
		return mb_strlen($text);
	}

	return strlen(utf8_decode($text));
}