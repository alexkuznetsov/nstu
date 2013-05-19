<?php

class Action_404 extends Action {

	public function execute()
	{
		echo Template::factory('err/404')->render();
	}
}