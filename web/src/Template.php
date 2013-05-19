<?php

class TemplateException extends Exception {

	public function __construct($message = "", $code = 0, Exception $previous = NULL)
	{
		// Pass the message and integer code to the parent
		parent::__construct($message, (int) $code, $previous);

		// Save the unmodified code
		// @link http://bugs.php.net/39615
		$this->code = $code;
	}
}

class Template {

	public static function factory($name, array $data = array())
	{
		return new Template($name, $data);
	}

	private $name;
	private $fullPath;
	private $data;

	public function __construct($name, array $data = array())
	{
		$this->name = $name;
		$this->fullPath = VIEWROOT . $name . '.php';
		$this->data = $data;
	}

	public function render()
	{
		if (file_exists($this->fullPath))
		{
			ob_start();
			extract($this->data);

			include $this->fullPath;

			return ob_get_clean();
		}

		throw new TemplateException(strtr('Template :name not found [:path]', array(
			':name' => $this->name,
			':path' => $this->fullPath,
		)));
	}
}