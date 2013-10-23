<?php

class DatabaseManager {

	private $mysqli;

	/**
	* Creates the DatabaseManager instance.
	*
	* @access	public
	* @return	DatabaseManager
	**/
	public function __construct() {
		$this->mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

		// Check for error.
		if(mysqli_connect_errno($this->mysqli)) {
			die("Error: Could not connect to MySQL database.");
		}

	}

	/**
	* Gets all the posts in array format.
	*
	* @access	public
	* @return	mixed
	**/
	public function getPosts() {
		$query = "SELECT * FROM `posts`";

		$result = $this->queryDB($query);

		/* Now we format it into our standard post format. */
		$posts = array();
		while($row = $result->fetch_assoc()) {
			$id = $row['id'];

			$posts[$id] = array(
				"id" => $id,
				"author" => $row['author'],
				"title" => $row['title'],
				"content" => $row['content'],
				"date" => $row['date'],
				"link" => "",
				);
		}

		return $posts;
	}

	/**
	* Sees whether a username is valid or not.
	*
	* @access	public
	* @return	boolean
	**/
	public function isValidUser($username) {
		$username = mysqli_real_escape_string($this->mysqli, $username);
		$query = "SELECT * FROM `users` WHERE ";

	}

	/**
	* Querys the database.
	*
	* @access	private
	* @return	mixed
	* @param	string	$query The string of SQL to query the database with.
	**/
	private function queryDB($query = null) {
		if($query == null) {
			throw new Exception("The query cannot be null!");
		}

		// Query!
		$result = mysqli_query($this->mysqli, $query);

		// Did we encounter an error?
		if( !$result ) {
			die("MySQL Query Error.");
		}

		return $result;
	}


	
}