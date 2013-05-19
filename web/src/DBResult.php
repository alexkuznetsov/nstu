<?php

class DBResult implements Countable, Iterator, SeekableIterator, ArrayAccess {

	private $resource;
	private $_current_row;
	private $_internal_row;
	private $_as_object;
	private $_object_params;

	public function __construct($resource, $_as_object = FALSE, $_object_params = NULL)
	{
		$this->resource = $resource;
		$this->_total_rows = mysql_num_rows($resource);
		$this->_as_object = $_as_object;
		$this->_object_params = $_object_params;
	}

	public function __destruct()
	{
		if (is_resource($this->resource))
		{
			mysql_free_result($this->resource);
		}
	}

	public function seek($offset)
	{
		if ($this->offsetExists($offset) AND mysql_data_seek($this->resource, $offset))
		{
			// Set the current row to the offset
			$this->_current_row = $this->_internal_row = $offset;

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function current()
	{
		if ($this->_current_row !== $this->_internal_row AND ! $this->seek($this->_current_row))
			return NULL;

		// Increment internal row for optimization assuming rows are fetched in order
		$this->_internal_row++;

		if ($this->_as_object === TRUE)
		{
			// Return an stdClass
			return mysql_fetch_object($this->resource);
		}
		elseif (is_string($this->_as_object))
		{
			// Return an object of given class name
			return mysql_fetch_object($this->resource, $this->_as_object, $this->_object_params);
		}
		else
		{
			// Return an array of the row
			return mysql_fetch_assoc($this->resource);
		}
	}

	public function next()
	{
		++$this->_current_row;
		return $this;
	}

	public function key()
	{
		return $this->_current_row;
	}

	public function valid()
	{
		return $this->offsetExists($this->_current_row);
	}

	public function rewind()
	{
		$this->_current_row = 0;
		return $this;
	}

	public function count()
	{
		return $this->_total_rows;
	}

	public function offsetExists($offset)
	{
		return ($offset >= 0 AND $offset < $this->_total_rows);
	}

	public function offsetGet($offset)
	{
		if ( ! $this->seek($offset))
			return NULL;

		return $this->current();
	}

	public function offsetSet($offset, $value)
	{
		throw new Exception('Database results are read-only');
	}

	public function offsetUnset($offset)
	{
		throw new Exception('Database results are read-only');
	}
}