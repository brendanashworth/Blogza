<?php

/**
* The DatabaseManager class, used to simplify management of the database.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Database {

	/* These are the cached query results. */
	private static $posts = null;

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
	* Checks whether the Database is initialized.
	*
	* This test only tests for the `posts` table.
	*
	* @access 	public
	* @return 	boolean 	Returns true if it is initialized, returns false if isn't initialized.
	**/
	public static function isInitialized() {
		$query = "SELECT * FROM `posts`";

		$result = self::queryDB($query, true);

		return $result;
	}

	public static function initialize() {
		$load = file_get_contents(BLOGZA_DIR . "/system/assets/sql/initialize_db.sql");

		self::multipleQueryDB($load);
	}

	/**
	* Creates and inserts the post into the database.
	*
	* @access 	public
	* @param	string	$author		The author of the post.
	* @param	string	$title 		The title of the post.
	* @param	string 	$content 	The content of the post.
	* @return 	bool|result
	**/
	public static function createPost($author = null, $title = null, $content = null) {
		// If any were null, throw an exception.
		if($author == null || $title == null || $content == null) {
			throw new DBException("The author, title, or content cannot be null!");
		}

		// Sanitize these inputs.
		//$author  = mysqli_real_escape_string(null, $author);
		//$title   = mysqli_real_escape_string(null, $title);
		//$content = mysqli_real_escape_string(null, $content);

		// Here is the query and execution.
		$query = "INSERT INTO `posts` (post_author, post_title, post_content) VALUES ('$author', '$title', '$content')";

		$result = self::queryDB($query);

		// Give a result.
		if($result == true || $result == false) {
			return $result;
		} else {
			// Uh... why didn't it return true or false? Was it just bypassed?
			return false;
		}

	}

	/**
	* Gets all the posts in array format.
	*
	* @access	public
	* @return	array
	**/
	public static function getPosts() {
		$query = "SELECT * FROM `posts`"; // Direct query into DB, no variables.

		$result = self::queryDB($query);

		/* Now we format it into our standard post format. */
		$posts = array();
		while($row = $result->fetch_assoc()) {
			$id = $row['id'];

			$posts[$id] = new Post($row['post_title'], $row['post_author'], $row['post_content'], $row['post_date'], $id);
		}

		return $posts;
	}

	public static function getPost($id) {
		if($id == null) {
			throw new DBException("The post ID cannot be null!");
		} else if (!is_numeric($id)) {
			throw new DBException("The post ID needs to be an integer!");
		}

		//$id = mysqli_real_escape_string($id);

		$query = "SELECT * FROM `posts` WHERE id='$id'";

		$result = self::queryDB($query);

		// Now we format.
		if($result->num_rows != 1) {
			return null;
		} else {
			$row = $result->fetch_assoc();

			return array(
				"id" => $row['id'],
				"author" => $row['post_author'],
				"title" => $row['post_title'],
				"content" => $row['post_content'],
				"date" => $row['post_date'],
				"link" => "/post/".$row['id'],
				);
		}

	}

	/**
	* Creates and inserts a new user into the database.
	*
	* @access	public
	* @param	string	$username	The user's display name. This is used for all blog posts.
	* @param	string	$password	The user's password. This will be hashed in this function.
	* @return	bool|result
	**/
	public static function createUser($username = null, $password = null, $rank = "Registered") {
		// If any given variables were null, throw an exception.
		if($username == null || $password == null) {
			throw new DBException("The username or password cannot be null!");
		}

		// Sanitize.
		//$username = mysqli_real_escape_string(null, $username);
		//$password = mysqli_real_escape_string(null, $password);

		// Hash the password.
		$password = Util::hashPassword($password);

		$query = "INSERT INTO `users` (user_name, user_password, user_posts, user_rank) VALUES ('$username', '$password', '0', '$rank')";

		$result = self::queryDB($query);

		// Give a result.
		if($result == true || $result == false) {
			return $result;
		} else {
			// Uh... why didn't it return true or false? Was it just bypassed?
			return false;
		}
	}

	/**
	* Gets the user from the database.
	*
	* @access	public
	* @param	string	$username	The user's name.
	* @return	User	Returns the User object if found; null if not found.
	**/
	public static function getUser($username) {
		$query = "SELECT * FROM `users`";

		$result = self::queryDB($query);

		$found = false;
		// Lets find our user.
		while($row = $result->fetch_assoc()) {
			if($row['user_name'] == $username) $found = $row;
		}

		if($found == false) {
			// Return null
			return null;
		} else {
			// Make the user.
			$user = new User($found['user_name'], $found['user_password'], $found['user_posts'], $found['user_rank']);
			return $user;
		}
	}

	/**
	* Gets all the users from the database and returns them in array format.
	*
	* @access 	public
	* @return 	array 	The array of Users from the database.
	**/
	public static function getUsers() {
		$query = "SELECT * FROM `users`";

		$result = self::queryDB($query);

		$users = array();
		while($row = $result->fetch_assoc()) {
			$users[] = new User($row['user_name'], $row['user_password'], $row['user_posts'], $row['user_rank']);
		}

		return $users;
	}

	/**
	* This function checks the connection to the database. 
	*
	* Via mysqli_connect, it returns whether or not the connection was successful.
	*
	* @access 	public
	* @return 	boolean 	Whether or not the connection was successful.
	**/
	public static function checkConnection() {
		try {
			$mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
		} catch (mysqli_sql_exception $e) {
			return false;
		}

		return true;
	}

	/**
	* Querys the database.
	*
	* @access	private
	* @param	string 		$query 	The string of SQL to query the database with.
	* @param 	boolean 	$bool 	If true, the query does not die on error, it simply returns false.
	* @return	mixed
	**/
	private static function queryDB($query = null, $bool = false) {
		if($query == null) {
			throw new DBException("The query cannot be null!");
		}
		
		$mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

		// Query!
		$result = mysqli_query($mysqli, $query);

		// Did we encounter an error?
		if( !$result && !$bool ) {
			Util::kill("MySQL error occurred.");
		}

		return $result;
	}

	/**
	* Querys the database with multiple queries.
	*
	* @access	private
	* @param	string 		$query 	The string of SQL queries for the database.
	* @param 	boolean 	$bool 	If true, the query does not die on error, it simply returns false.
	* @return	mixed
	**/
	private static function multipleQueryDB($query = null, $bool = false) {
		if($query == null) {
			throw new DBException("The query cannot be null!");
		}

		$mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

		$result = mysqli_multi_query($mysqli, $query);

		if( !$result && !$bool ) {
			Util::kill("MySQL error occurred.");
		}

		return $result;
	}
	
}