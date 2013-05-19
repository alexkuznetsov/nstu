<?php

abstract class Action {

	/**
	 * @var Request
	 */
	private $request;

	public function __construct()
	{
		$this->request = new Request();
	}

	public function request()
	{
		return $this->request;
	}

	public function executeAction() {
		$this->beforeExecute();
		$this->execute();
		$this->afterExecute();
	}

	abstract function execute();

	public function beforeExecute()
	{
		echo Template::factory('header')->render();
	}

	public function afterExecute()
	{
		echo Template::factory('footer')->render();
	}

}