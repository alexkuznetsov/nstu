<?php

class Action_Cookie extends Action {

	public function beforeExecute()
	{

	}

	public function afterExecute()
	{

	}

	public function execute()
	{
		if (Arr::has_key($this->request()->post(), 'save'))
		{
			$name = $this->request()->post('name');

			setcookie('user', htmlentities($name), time() + 3600);
			setcookie('date', date('Y.m.d'), time() + 3600);
		}
		else
		{
			setcookie('user', '', -3600);
			setcookie('date', '', -3600);
		}

		header('Location: index.php?a=form');
	}
}