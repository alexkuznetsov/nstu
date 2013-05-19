<?php

class Action_Gb_AddMessage extends Action {

	public function beforeExecute() { }

	public function afterExecute() { }

	public function execute()
	{
		if (isset($_POST['add']))
		{
			$name = strip_tags($this->request()->post('name'));
			$message = str_replace(array("\r", "\n"), '', nl2br(strip_tags($this->request()->post('message'), '<p><strong><b><em><i>')));

			if (strlen($name) > 0 AND strlen($message) > 0)
			{
				$file = APPROOT.'data'.DS.'data.txt';
				$date = date('Y/m/d');
				$f = fopen($file, 'a');
				flock($f, LOCK_EX);
				$likesRaw = (array) $this->request()->post('likes');
				$likes = '';
				
				if (count($likesRaw) > 0)
				{
					$likes = '<div class="likes">' .implode(', ', $likesRaw). '</div>';
				}
				
				$record = "<h4>[$date] $name wrote:</h4><div class=\"msg\">$message</div>$likes\r\n";
				fwrite($f, $record);
				flock($f, LOCK_UN);
				fclose($f);
			}
		}
		elseif (isset($_POST['clear'])) 
		{
			$file = APPROOT.'data'.DS.'data.txt';

			if (file_exists($file))
			{
				unlink($file);
			}
		}

		header('Location: ?a=gb');
	}
}