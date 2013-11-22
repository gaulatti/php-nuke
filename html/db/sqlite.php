<?php
/***************************************************************************
 *                                 sqlite.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: sqlite.php,v 1.16 2002/03/19 01:07:36 psotfx Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if(!defined('SQL_LAYER'))
{

define('SQL_LAYER', 'sqlite');

class sql_db
{

	var $db_connect_id;
	var $query_result;
	var $row = array();
	var $rowset = array();
	var $num_queries = 0;

	//
	// Constructor
	//
	function sql_db($sqlserver, $trash, $trash, $trash, $persistency = true)
	{
		$this->persistency = $persistency;
		$this->server = $sqlserver;

		$this->db_connect_id = ($this->persistency) ? @sqlite_popen($this->server, 0666, $sqliteerror) : @sqlite_open($this->server, 0666, $sqliteerror);

		return ($this->db_connect_id) ? $this->db_connect_id : false;
	}

	//
	// Other base methods
	//
	function sql_close()
	{
		return ($this->db_connect_id) ? @sqlite_close($this->db_connect_id) : false;
	}

	//
	// Base query method
	//
	function sql_query($query = '', $transaction = FALSE)
	{
		// Remove any pre-existing queries
		unset($this->query_result);

		if($query != '')
		{
			$this->num_queries++;

			$this->query_result = @sqlite_query($query, $this->db_connect_id);
		}

		if($this->query_result)
		{
			unset($this->row[$this->query_result]);
			unset($this->rowset[$this->query_result]);

			return $this->query_result;
		}
		else
		{
			return ( $transaction == END_TRANSACTION ) ? true : false;
		}
	}

	//
	// Other query methods
	//
	function sql_numrows($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		if($query_id)
		{
			return @sqlite_num_rows($query_id);
		}
		else
		{
			return false;
		}
	}

	function sql_affectedrows()
	{
		return ($this->db_connect_id) ? @sqlite_changes($this->db_connect_id) : false;
	}

	function sql_numfields($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		return ($query_id) ? @sqlite_num_fields($query_id) : false;
	}

	function sql_fieldname($offset, $query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		return ($query_id) ? @sqlite_field_name($query_id, $offset) : false;
	}

	function sql_fieldtype($offset, $query_id = 0)
	{
		exit('sql_fieldtype called');

		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		// return ($query_id) ? @mysql_field_type($query_id, $offset) : false;
		return ($query_id) ? 'varchar' : false;
	}

	function sql_fetchrow($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		if($query_id)
		{
			//$this->row[$query_id] = @sqlite_fetch_array($query_id);
			//return $this->row[$query_id];


			$result = sqlite_fetch_array($query_id);

			if ($result)
			{
				foreach ($result as $key => $value)
				{
					if ($pos = strpos($key, '.'))
					{
						$key = substr($key, $pos+1);
					}

					$array[$key] = $value;
				}
			}

			$this->row[$query_id] = $array;

			return $this->row[$query_id];
		}
		else
		{
			return false;
		}
	}

	function sql_fetchrowset($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		if($query_id)
		{
			unset(
				$this->rowset[$query_id],
				$this->row[$query_id]
				);

			while($this->rowset[$query_id] = @sqlite_fetch_array($query_id))
			{
				foreach ($this->rowset[$query_id] as $key => $value)
				{
					if ($pos = strpos($key, '.'))
					{
						$key = substr($key, $pos+1);
					}

					$array[$key] = $value;
				}

				$result[] = $array;
			}

			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_fetchfield($field, $rownum = -1, $query_id = 0)
	{
		exit('sql_fetchfield called');

		if( !$query_id )
		{
			$query_id = $this->query_result;
		}

		if( $query_id )
		{
			if( $rownum > -1 )
			{
				$result = mysql_result($query_id, $rownum, $field);
			}
			else
			{
				if( empty($this->row[$query_id]) && empty($this->rowset[$query_id]) )
				{
					if( $this->sql_fetchrow() )
					{
						$result = $this->row[$query_id][$field];
					}
				}
				else
				{
					if( $this->rowset[$query_id] )
					{
						$result = $this->rowset[$query_id][$field];
					}
					else if( $this->row[$query_id] )
					{
						$result = $this->row[$query_id][$field];
					}
				}
			}

			return $result;
		}
		else
		{
			return false;
		}
	}

	function sql_rowseek($rownum, $query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		return ($query_id) ? @sqlite_seek($query_id, $rownum) : false;
	}

	function sql_nextid()
	{
		return ($this->db_connect_id) ? @sqlite_last_insert_rowid($this->db_connect_id) : false;
	}

	function sql_freeresult($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		if ( $query_id )
		{
			unset(
				$this->row[$query_id],
				$this->rowset[$query_id]
				);

			//@mysql_free_result($query_id);

			return true;
		}
		else
		{
			return false;
		}
	}

	function sql_error()
	{
		$result['code'] = sqlite_last_error($this->db_connect_id);
		$result['message'] = sqlite_error_string($result['code']);

		return $result;
	}

} // class sql_db

} // if ... define

?>