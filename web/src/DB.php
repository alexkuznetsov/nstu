<?php

class DB {

	private $is_connected = FALSE;
	private $dbh;
	
	protected function _init()
	{
		if ( ! $this->is_connected)
		{
			$this->dbh = mysql_connect('localhost', 'user', 'pass');

			if ( ! mysql_select_db('db', $this->dbh))
			{
				throw new DBConnectException(mysql_error($this->dbh), mysql_errno($this->dbh));
			}

			mysql_query('SET NAMES UTF8');
			
			$this->is_connected = TRUE;
		}
	}
	
	public function query($sql, array $params=NULL)
	{
		$this->_init();
		
		if ($params !== NULL)
		{
			$sql = strtr($sql, $params);
		}
		
		if (($res = mysql_query($sql, $this->dbh)) === FALSE)
		{
			throw new DBSqlException(strtr(':error [ :query ]',
				array(':error' => mysql_error($this->dbh), ':query' => $sql)), mysql_errno($this->dbh));
		}
		
		return $res;
	}

	public function insert_id()
	{
		return mysql_insert_id($this->dbh);
	}

	public function affected_rows()
	{
		return mysql_affected_rows($this->dbh);
	}
	
	public function __destruct()
	{
		if ( is_resource($this->dbh) )
		{
			mysql_close($this->dbh);
		}
	}
}

class DBConnectException extends Exception {

	public function __construct($message = "", $code = 0, Exception $previous = NULL)
	{
		// Pass the message and integer code to the parent
		parent::__construct($message, (int) $code, $previous);

		// Save the unmodified code
		// @link http://bugs.php.net/39615
		$this->code = $code;
	}
}

class DBSqlException extends Exception {

	public function __construct($message = "", $code = 0, Exception $previous = NULL)
	{
		// Pass the message and integer code to the parent
		parent::__construct($message, (int) $code, $previous);

		// Save the unmodified code
		// @link http://bugs.php.net/39615
		$this->code = $code;
	}
}