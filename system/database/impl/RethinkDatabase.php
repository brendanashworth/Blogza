<?php

/**
* The RethinkDatabase class, a RethinkDB implementation of the Database.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class RethinkDatabase extends Database {

	/* ** DATABASE PROTOCOL *
	 *
	 * 1) 'WHERE' fields should always be heavily sanitized.
	 * 2) All SQL queries must exist in this class and this class only. No outside access to the SQLi object is allowed. (security)
	 * 3) If no special sanitization method exists, use addslashes() *then* mysqli_real_escape_string().
	 */

	private static $conn = null;

	/**
	* Checks whether the Database is initialized.
	*
	* Note: this test only tests for the `posts` table.
	*
	* @access 	public
	* @return 	boolean 	Returns true if it is initialized, returns false if isn't initialized.
	**/
	public static function isInitialized() {
		
	}

	/**
	* Initializes the database. Danger: This is a very dangerous method and can be quite volatile.
	*
	* @access 	public
	* @return 	void
	**/
	public static function initialize() {
		
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
		
	}

	/**
	* Gets all the posts in array format.
	*
	* @access	public
	* @return	array 	An array of all the Post objects.
	**/
	public static function getPosts() {
		
	}

	/**
	* Gets the Post object by identifier $id.
	*
	* @access 	public
	* @param 	int 	$id 	The ID of the post.
	* @return 	Post 	The Post object representation of the post.
	**/
	public static function getPost($id) {
		
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
		
	}

	/**
	* Adds another number to the user's post amount.
	*
	* @access 	public
	* @param 	string|int 	$user 	The username or ID of the user.
	* @return 	void
	**/
	public static function addPost($user) {
		
	}

	/**
	* Gets the user from the database.
	*
	* @access	public
	* @param	string|int	$identifier	The user's name or ID.
	* @return	User		Returns the User object if found; null if not found.
	**/
	public static function getUser($identifier) {
		
	}

	/**
	* Gets all the users from the database and returns them in array format.
	*
	* @access 	public
	* @return 	array 	The array of Users from the database.
	**/
	public static function getUsers() {
		
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
		
	}

	/**
	* Updates the user's username in the database.
	*
	* @access 	public
	* @param 	string 	$user 	The user's name.
	* @param 	string 	$newname 	The user's new username.
	* @return 	void
	**/
	public static function updateUserName($user, $newname) {
		
	}

	/**
	* Updates a user's rank in the database.
	*
	* @access 	public
	* @param 	string 	$user 	The user's name.
	* @param 	string 	$rank 	The user's new rank.
	* @return 	void
	**/
	public static function updateUserRank($user, $rank) {
		
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
		
	}

	/**
	* Gets all comments that are not approved by the admin panel.
	*
	* @access 	public
	* @return 	array 	The array of Comments that are not approved.
	**/
	public static function getCommentsNotApproved() {
		
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
		
	}

	/**
	* Querys the database.
	*
	* @access	private
	* @param	string 		$query 	The string to query the database with.
	* @param 	boolean 	$bool 	If true, the query does not die on error, it simply returns false.
	* @return	mixed
	**/
	private static function queryDB($query = null, $bool = false) {
		
	}

	/**
	* Querys the database with multiple queries.
	*
	* @access	private
	* @param	string 		$query 	The string of queries for the database.
	* @param 	boolean 	$bool 	If true, the query does not die on error, it simply returns false.
	* @return	mixed
	**/
	private static function multipleQueryDB($query = null, $bool = false) {
		
	}

	/**
	* Creates and returns a new Rethink connection for sanitization usage and queries.
	*
	* @access 	private
	* @return 	rdb 	The Rethink object.
	**/
	private static function newConnection() {
		// check if its already connected
		if(self::$conn != null) {
			return self::$conn;
		}

		// connect to rethinkdb
		self::$conn = r\connect(DB_HOST);
	}
	
}