<?php

class Request {

	private $_get = array();
	private $_post = array();

	public function __construct()
	{
		$this->_get = $_GET;
		$this->_post = $_POST;
	}

	public function query($name = NULL, $value = NULL)
	{
		if ($name === NULL)
		{
			return (array) $this->_get;
		}

		if ($value === NULL)
		{
			return Arr::get($this->_get, $name);
		}

		$this->_get[$name] = $value;
	}

	public function post($name = NULL, $value = NULL)
	{
		if ($name === NULL)
		{
			return (array) $this->_post;
		}

		if ($value === NULL)
		{
			return Arr::get($this->_post, $name);
		}

		$this->_post[$name] = $value;
	}
}