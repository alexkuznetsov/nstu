<?php

class Action_Index extends Action {

	public function execute()
	{
		echo Template::factory('index')->render();
	}
}