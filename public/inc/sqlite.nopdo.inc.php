<?php
/**
 * Simple database class. Handles the transactions between the website
 * and the sqlite database, for bruteforcing and logging.
 */
class DB 
{

	private $handle=null;
	
    /**
     * Construction function opens the sqlite database and declares the handle
     * to this object.
     */
	function __construct() 
    {
		$this->handle = sqlite_open(APP_PATH.'/db/sqlite.db', 0666, $error);
		if (!$this->handle)  {
			throw new Exception($error);
		}
	}
	
    /**
     * Installs the database with the given queries in this function. Should only
     * be called once, if the database is gone!
     */
	function install() 
    {
		$stm = 	"CREATE TABLE logins (Id integer PRIMARY KEY," . 
				"ipaddress varchar(39) NOT NULL, logged_time datetime, username varchar(100))";
		@$q = sqlite_exec($this->handle, $stm, $error);
		if (!$q) {
		   throw new Exception ("Cannot install database. $error");
		}
		
		$stm = "CREATE INDEX logged_time_index ON logins (logged_time)";
		@$q = sqlite_exec($this->handle, $stm, $error);
		if (!$q) {
		   throw new Exception ("Cannot install database. $error");
		}
	}
	
    /**
     * Store a login action in the database, combined with the IP and datetime.
     *
     * @param string $username   <The username that tried to log in>
     */
	function putLogin($username) 
    {
		$query = "INSERT INTO logins (ipaddress,logged_time,username) 
                VALUES ('" . $_SERVER["REMOTE_ADDR"]."', DATETIME('now'), '" . sqlite_escape_string($username) . "')";
		@$q = sqlite_query($this->handle, $query);
		
		if (!$q) {
		   throw new Exception ("Cannot query database. $error");
		}
	}
	
    /**
     * Get the number of logins from this ip, in the last $minutes minutes.
     *
     * @param int $minutes <Number of minutes>
     * @return int         <Number of login attempts in last $minutes minutes>
     */
	function getLoginsSince($minutes) 
    {
		$query = "SELECT COUNT(*) as times
                    FROM logins 
                    WHERE logged_time >= DATETIME('now', '-" . ($minutes*60) . " seconds') AND ipaddress='" . $_SERVER["REMOTE_ADDR"] . "'";
		@$q = sqlite_query($this->handle, $query);
		if (!$q) {
		   throw new Exception ("Cannot query database. $error");
		}
		
		$r = sqlite_fetch_array($q, SQLITE_NUM); 
		return (int)$r[0];
    }
}