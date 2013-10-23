<?php

class DatabaseManager {

	private $mysqli;

	/**
	* Creates the DatabaseManager instance.
	*
	* @return	DatabaseManager
	**/
	public function __construct() {
		$this->mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

		// Check for error.
		if(mysqli_connect_errno($this->mysqli)) {
			// die("Error: Could not connect to MySQL database.");
		}

	}

	/**
	* Gets all the posts in array format.
	*
	* @access	public
	* @return	mixed
	**/
	public function getPosts() {
		$result = $this->queryDB("SELECT * FROM posts"); // This query does not require sanitization because it is never changed.

		return array(
			"1" => array(
				"id" => 1,
				"author" => "boboman13",
				"title" => "This is a post title.",
				"content" => "Hello, and welcome to the blog!",
				"link" => "/post/1",
				),
			"2" => array(
				"id" => 2,
				"author" => "Author2",
				"title" => "Post #2",
				"content" => "content",
				"link" => "/post/2",
				),
			"3" => array(
				"id" => 3,
				"author" => "Author3",
				"title" => "Title Post #3",
				"content" => "content for #3",
				"link" => "/post/3",
				),
			);
	}

	/**
	* Querys the database. This method includes basic sanitization (SANITIZE BEFORE) and then returns the result.
	*
	* @access	private
	* @return	mixed
	* @param	string	$query The string of SQL to query the database with.
	**/
	private function queryDB($query = null) {
		if($query == null) {
			throw new Exception("The query cannot be null!");
		}

		// Sanitize.
		$query = mysqli_real_escape_string($this->mysqli, $query); // Do some MySQLi generic sanitization
		$query = htmlspecialchars($query); // Neutralize HTML

		$result = mysqli_query($this->mysqli, $query);

		// Sanitize again!
		$result = htmlspecialchars($result);

		return $result;
	}


	
}