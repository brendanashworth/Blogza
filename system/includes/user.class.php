<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class User {

	private $username;
	private $password;
	private $posts;

	/**
	* Creates the User instance.
	*
	* @access	public
	* @param 	$username 	The user's display name.
	* @param 	$password 	The user's password (hashed).
	* @param 	$posts 		The amount of posts the user has made.
	* @return 	mixed
	**/
	public function __construct($username, $password, $posts) {
		if($username == null || $password == null || $posts == null) {
			throw new Exception("The username, password, or posts cannot be null!");
		}

		$this->username = htmlspecialchars($username);
		$this->password = htmlspecialchars($password);
		$this->posts = htmlspecialchars($posts);
	}

	/**
	* Gets the username.
	*
	* @access 	public
	* @return 	string 	The username.
	**/
	public function getUsername() {
		return $this->username;
	}

	/**
	* Gets the hashed password.
	*
	* @access 	public
	* @return 	string 	The hashed password.
	**/
	public function getPassword() {
		return $this->password;
	}

	/**
	* Gets the amount of posts from the user.
	*
	* @access 	public
	* @return 	int 	The amount of posts the user has made.
	**/
	public function getPosts() {
		return $this->posts;
	}

}