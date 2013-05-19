<?php

class Action_Form extends Action {

	public function execute()
	{
		echo Template::factory('cookie/form')->render();
	}
}