<?php

/**
* The DatabaseManager class, used to simplify management of the database.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Database {

	/* ** DATABASE PROTOCOL *
	 *
	 * 1) 'WHERE' fields should always be heavily sanitized.
	 * 2) All SQL queries must exist in this class and this class only. No outside access to the SQLi object is allowed. (security)
	 * 3) If no special sanitization method exists, use addslashes() *then* mysqli_real_escape_string().
	 */

	/* This is the MySQLi connection object. */
	private static $conn = null;

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
	* Checks whether the Database is initialized.
	*
	* Note: this test only tests for the `posts` table.
	*
	* @access 	public
	* @return 	boolean 	Returns true if it is initialized, returns false if isn't initialized.
	**/
	public static function isInitialized() {
		$query = "SELECT * FROM `posts`";

		$result = self::queryDB($query, true);

		return $result;
	}

	/**
	* Initializes the database. Danger: This is a very dangerous method and can be quite volatile.
	*
	* @access 	public
	* @return 	void
	**/
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
	public static function createPost($author = null, $title = null, $content = null, $status = "done") {
		// If any were null, throw an exception.
		if($author == null || $title == null || $content == null) {
			throw new DBException("The author, title, or content cannot be null!");
		}

		// Sanitize these inputs.
		$author = Util::sanitizeAlphaNumerically($author);
		$status = Util::sanitizeAlphaNumerically($status);

		$title   = mysqli_real_escape_string(self::newConnection(), addslashes($title));
		$content = mysqli_real_escape_string(self::newConnection(), addslashes($content));

		$date = date("m/d/y");

		// Here is the query and execution.
		$query = "INSERT INTO `posts` (post_author, post_title, post_content, post_date, post_status) VALUES ('$author', '$title', '$content', '$date', '$status')";

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
	* Updates the post to the new content.
	*
	* @access 	public
	* @param 	int 	$id 	The ID of the post.
	* @param 	string 	$content 	The post's new content.
	* @return 	void
	**/
	public static function updatePost($id = null, $content = null) {
		if($id == null || $content == null) {
			throw new Exception("The post ID or content cannot be null!");
		}

		if(!is_numeric($id)) {
			throw new Exception("The post ID must be numeric!");
		}

		$content = mysqli_real_escape_string(self::newConnection(), addslashes($content));

		$query = "UPDATE `posts` SET `post_content`='$content' WHERE id='$id'";

		self::queryDB($query);
	}

	/**
	* Gets all the posts in array format.
	*
	* @access	public
	* @return	array 	An array of all the Post objects.
	**/
	public static function getPosts() {
		$query = "SELECT * FROM `posts`"; // Direct query into DB, no variables.

		$result = self::queryDB($query);

		/* Now we format it into our standard post format. */
		$posts = array();
		while($row = $result->fetch_assoc()) {
			$id = $row['id'];

			$posts[$id] = new Post($row['post_title'], $row['post_author'], $row['post_content'], $row['post_date'], $id, $row['post_status']);
		}

		return $posts;
	}

	/**
	* Gets the Post object by identifier $id.
	*
	* @access 	public
	* @param 	int 	$id 	The ID of the post.
	* @return 	Post 	The Post object representation of the post.
	**/
	public static function getPost($id) {
		if (!is_numeric($id)) {
			throw new DBException("The post ID needs to be an integer!");
		}

		$id = mysqli_real_escape_string(self::newConnection(), addslashes($id)); // Useless, no. Safe, yes.

		$query = "SELECT * FROM `posts` WHERE `id`='$id'";

		$result = self::queryDB($query);

		// Now we format.
		if($result->num_rows != 1) {
			return null;
		} else {
			$row = $result->fetch_assoc();

			return new Post($row['post_title'], $row['post_author'], $row['post_content'], $row['post_date'], $id, $row['post_status']);
		}

	}

	/**
	* Creates and inserts a new user into the database.
	*
	* @access	public
	* @param	string	$username	The user's display name. This is used for all blog posts.
	* @param	string	$password	The user's password. This will be hashed in this function.
	* @param 	string 	$email 		The user's email.
	* @param 	string 	$rank 		The user's rank; this rank defaults to Registered.
	* @return	bool|result
	**/
	public static function createUser($username = null, $password = null, $email = null, $rank = "Registered", $ip) {
		// If any given variables were null, throw an exception.
		if($username == null || $password == null || $email == null || empty($rank) || empty($ip)) {
			throw new DBException("The username, password, email, rank, and/or IP cannot be null!");
		}

		// Sanitize.
		$username = Util::sanitizeAlphaNumerically($username);
		$password = Util::sanitizeAlphaNumerically($password);

		if(!Util::sanitizeEmail($email)) {
			throw new Exception("Not a valid email.");
		}
		
		$email = mysqli_real_escape_string(self::newConnection(), addslashes($email));
		$ip = mysqli_real_escape_string(self::newConnection(), addslashes($ip));

		$rank = Util::sanitizeAlphaNumerically($rank);

		// Hash the password.
		$password = Util::hashPassword($password);

		$query = "INSERT INTO `users` (user_name, user_password, user_posts, user_email, user_rank, user_ips) VALUES ('$username', '$password', '0', '$email', '$rank', '$ip')";

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
	* Adds a user's IP to the user's list.
	*
	* This is a multi-query function; first it queries the database for the current user's IPs, then it queries the database again
	* to append the new IP to the list of IPs it had previously retrieved from the database. This function does not add the IP if
	* it already exists in the database.
	*
	* @access 	public
	* @param 	$user 	string|int 	The username of the user OR the user's id.
	* @param 	$ip 	string 	The IP address to add.
	* @return 	void
	**/
	public static function addUserIP($user, $ip) {
		//$ip = preg_match('/([^0-9]|\.)+/', '', $ip);
		$ip = mysqli_real_escape_string(self::newConnection(), addslashes($ip));

		if(is_numeric($user)) {
			$query = "SELECT * FROM `users` WHERE `id`='$user'";
		} else {
			$user = Util::sanitizeAlphaNumerically($user);
			$query = "SELECT * FROM `users` WHERE `user_name`='$user'";
		}

		$result = self::queryDB($query);

		if($result == false || mysqli_num_rows($result) != 1) {
			return;
		} else {
			$row = $result->fetch_assoc();
			$current = $row['user_ips'];
		}

		if(empty($current)) {
			$give = $ip;
		} else {
			$temp = explode(',', $current);
			if(in_array($ip, $temp)) {
				// We don't need to add an IP that already exists.
				return;
			}
			$give = $current . "," . $ip;
		}

		$give = mysqli_real_escape_string(self::newConnection(), addslashes($give));

		if(is_numeric($user)) {
			$query = "UPDATE `users` SET `user_ips`='$give' WHERE `id`='$user'";
		} else {
			$user = Util::sanitizeAlphaNumerically($user);
			$query = "UPDATE `users` SET `user_ips`='$give' WHERE `user_name`='$user'";
		}
		
		$result = self::queryDB($query);
	}

	/**
	* Adds another number to the user's post amount.
	*
	* @access 	public
	* @param 	string|int 	$user 	The username or ID of the user.
	* @return 	void
	**/
	public static function addPost($user) {
		// Get the amount of current posts.
		if(is_numeric($user)) {
			$query = "SELECT * FROM `users` WHERE `id`='$user'";
		} else {
			$user = Util::sanitizeAlphaNumerically($user);
			$query = "SELECT * FROM `users` WHERE `user_name`='$user'";
		}

		$result = self::queryDB($query);

		if($result == false || mysqli_num_rows($result) != 1) {
			return;
		} else {
			$row = $result->fetch_assoc();
			$posts = $row['user_posts'];
		}

		$num = $posts + 1;
		$num = mysqli_real_escape_string(self::newConnection(), addslashes($num));

		if(is_numeric($user)) {
			$query = "UPDATE `users` SET `user_posts`='$num' WHERE `id`='$user'";
		} else {
			$user = Util::sanitizeAlphaNumerically($user);
			$query = "UPDATE `users` SET `user_posts`='$num' WHERE `user_name`='$user'";
		}
		
		$result = self::queryDB($query);
	}

	/**
	* Gets the user from the database.
	*
	* @access	public
	* @param	string|int	$identifier	The user's name or ID.
	* @return	User		Returns the User object if found; null if not found.
	**/
	public static function getUser($identifier) {
		if(is_numeric($identifier)) {
			$query = "SELECT * FROM `users` WHERE `id`='$identifier'";
		} else {
			$username = Util::sanitizeAlphaNumerically($identifier);
			$query = "SELECT * FROM `users` WHERE `user_name`='$username'";
		}

		$result = self::queryDB($query);

		// User not found or multiple entries for the same user. If either are true, return null.
		if($result == false || mysqli_num_rows($result) != 1) {
			return null;
		} else {
			$row = $result->fetch_assoc();
			$user = new User($row['user_name'], $row['user_password'], $row['user_posts'], $row['user_rank'], $row['user_email'], $row['id'], $row['user_ips']);
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
			$users[] = new User($row['user_name'], $row['user_password'], $row['user_posts'], $row['user_rank'], $row['user_email'], $row['id'], $row['user_ips']);
		}

		return $users;
	}

	/**
	* Updates the user with a new password.
	*
	* @access 	public
	* @param 	$user 	The username to update.
	* @param 	$password 	The new user's password.
	* @return 	void
	**/
	public static function updateUserPassword($user, $password) {
		$user = Util::sanitizeAlphaNumerically($user);
		$password = Util::sanitizeAlphaNumerically($password);

		$password = Util::hashPassword($password);

		$query = "UPDATE `users` SET `user_password`='$password' WHERE `user_name`='$user'";

		self::queryDB($query);
	}

	/**
	* Updates the user's email in the database.
	*
	* @access 	public
	* @param 	string 	$user 	The user's name.
	* @param 	string 	$email 	The user's new email.
	* @return 	void
	**/
	public static function updateUserEmail($user, $email) {
		$user = Util::sanitizeAlphaNumerically($user);
		if(!Util::sanitizeEmail($email)) {
			throw new Exception("Not a valid email.");
		}

		$email = mysqli_real_escape_string(self::newConnection(), addslashes($email));

		$query = "UPDATE `users` SET `user_email`='$email' WHERE `user_name`='$user'";

		self::queryDB($query);
	}

	/**
	* Creates a comment for a post.
	*
	* @access 	public
	* @param 	int 	$post 	The ID of the post that the comment is on.
	* @param 	string 	$author 	The name of the comment's author.
	* @param 	string 	$content 	The content of the post.
	* @return 	void
	**/
	public static function createComment($post, $author, $content) {
		// Sanitize input.
		if(!is_numeric($post)) {
			throw new Exception("The post ID must be numeric.");
		}

		$author = Util::sanitizeAlphaNumerically($author);
		$content = mysqli_real_escape_string(self::newConnection(), addslashes($content));

		$ismod = "no";
		$date = date('m/d/y');

		$query = "INSERT INTO `comments` (comment_post, comment_is_moderated, comment_poster, comment_date, comment_content) VALUES ('$post', '$ismod', '$author', '$date', '$content')";

		self::queryDB($query);
	}

	/**
	* Gets the comments for the specified post.
	*
	* @access 	public
	* @param 	int 	$post 	The id of the post to get the comments for.
	* @param 	bool 	$all 	If true, use all comments. Defaults to false for only approved comments.
	* @return 	array
	**/
	public static function getComments($post, $all = false) {
		if(!is_numeric($post)) {
			throw new Exception("The post ID must be numeric.");
		}

		$query = "SELECT * FROM `comments` WHERE `comment_post`='$post'";

		// Should we only use moderated comments?
		if(!$all) {
			$query .= " AND `comment_is_moderated`='yes'";
		}

		$result = self::queryDB($query);

		// Checks if there are no comments.
		if(mysqli_num_rows($result) < 1) {
			return null;
		} else {
			$comments = array();
			while($row = $result->fetch_assoc()) {
				$poster = self::getUser($row['comment_poster']);
				$comments[] = new Comment($row['id'], $row['comment_post'], $poster, $row['comment_is_moderated'], $row['comment_content'], $row['comment_date']);
			}

			return $comments;
		}
	}

	/**
	* Gets all comments that are not approved by the admin panel.
	*
	* @access 	public
	* @return 	array 	The array of Comments that are not approved.
	**/
	public static function getCommentsNotApproved() {
		$query = "SELECT * FROM `comments` WHERE `comment_is_moderated`='no'";

		$result = self::queryDB($query);

		$comments = array();
		while($row = $result->fetch_assoc()) {
			$poster = self::getUser($row['comment_poster']);
			$comments[] = new Comment($row['id'], $row['comment_post'], $poster, $row['comment_is_moderated'], $row['comment_content'], $row['comment_date']);
		}

		return $comments;
	}

	/**
	* Updates the comment_is_moderated field to the supplied value.
	*
	* @access 	public
	* @param 	int 	$comment 	The id of the comment.
	* @param 	string 	$value 		The value to update the field with.
	* @return 	void
	**/
	public static function updateCommentApproved($comment, $value = false) {
		if(!is_numeric($comment)) {
			throw new Exception("Not a valid post comment ID.");
		}
		$value = Util::sanitizeAlphaNumerically($value);

		$query = "UPDATE `comments` SET `comment_is_moderated`='$value' WHERE `id`='$comment'";

		self::queryDB($query);
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
			$mysqli = self::newConnection();
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
		
		$mysqli = self::newConnection();

		// Query!
		$result = mysqli_query($mysqli, $query);

		// Did we encounter an error?
		if( !$result && !$bool ) {
			Util::kill("MySQL error occurred.");
		} else {
			// Now we collect the basic stats.
			self::$queries = self::$queries + 1;
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

		$mysqli = self::newConnection();

		$result = mysqli_multi_query($mysqli, $query);

		if( !$result && !$bool ) {
			Util::kill("MySQL error occurred.");
		} else {
			// Basic stats generating.
			self::$queries = self::$queries + 1;
		}

		return $result;
	}

	/**
	* Creates and returns a new MySQLi connection for sanitization usage and queries.
	*
	* @access 	private
	* @return 	mysqli 	The MySQLi object.
	**/
	private static function newConnection() {
		// Check for an already connected MySQLi object.
		if(self::$conn != null) {
			return self::$conn;
		}

		if( ! $conn = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE)) {
			Util::abort(1);
			return null;
		} else {
			self::$conn = $conn;
			return $conn;
		}

	}
	
}