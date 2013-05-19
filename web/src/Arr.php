<?php


class Arr {

	public static function get(array $array, $name)
	{
		return isset($array[$name]) ? $array[$name] : NULL;
	}

	public static function has_key(array $array, $key)
	{
		return array_key_exists($key, $array);
	}

}