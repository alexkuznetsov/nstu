<?php


class Debug {

	public static function path($file)
	{
		return str_replace(array(
			APPROOT, VIEWROOT
		), array(
			'[APPROOT]' . DS, '[VIEWROOT]' . DS
		), $file);
	}
}