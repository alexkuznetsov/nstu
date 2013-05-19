<?php

class Action_Gb extends Action {

	public function execute()
	{
		$file = APPROOT . 'data'.DS.'data.txt';
		$data = array();

		if (file_exists($file))
		{
			$data['messages'] = file($file);
		}

		echo Template::factory('gb/index', $data)->render();
	}

}