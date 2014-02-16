<?php

/**
* The DatabaseManager class, used to simplify management of the database.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Database {

	/* This is the implementation used. */
	protected static $impl;

	/* This is the amount of sent queries. */
	public static $queries = 0;

	/**
	* Creates the Database instance.
	*
	* Private to restrict creation of the object.
	*
	* @access	private
	* @return	Database
	**/
	private function __construct() {

	}

	/**
	* Set the Database implementation to be used by Blogza.
	*
	* @access 	public
	* @param 	string 	$impl 	The implementation to be used.
	* @return 	void
	**/
	public static function setImplementation($impl = "MySQLDatabase") {
		require BLOGZA_DIR . "/system/database/impl/" . $impl . ".php";
		self::$impl = $impl;
	}

	/**
	* Add a query to the running tally.
	*
	* @access 	protected
	* @return 	void
	**/
	protected static function addQuery() {
		self::$queries = self::$queries + 1;
	}


	/**
	* This method is the powering method behind the Database. It catches any not already defined static method calls, then forwards it to the set Database Implementation chosen.
	*
	* @access 	public
	* @param 	string 	$name 	The name of the function being called.
	* @param 	array 	$args 	The arguments of the function being called.
	* @return 	void
	**/
	public static function __callStatic($name, $args) {
		if($name == 'addQuery' || $name == 'setImplementation') return;

		return forward_static_call_array(array(self::$impl, $name), $args);
	}
	
}