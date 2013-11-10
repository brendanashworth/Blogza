<?php

/**
* The Auth class, used for account authentication.
**/
class Auth {

	/**
	* Construction method, made private to disallow object creation.
	*
	* @access 	private
	* @return 	Auth
	**/
	private function __construct() {

	}

	/**
	* Logs the user in.
	*
	* @access 	public
	* @param 	string 	$username 	The user's name.
	* @return 	void
	**/
	public static function login($username) {
		$_SESSION['auth_username'] = $username;
	}

	/**
	* Logs the user out.
	*
	* @access 	public
	* @return 	void
	**/
	public static function logout() {
		unset($_SESSION['auth_username']);
	}

	/**
	* Checks whether the visitor is logged in or not.
	*
	* @access 	public
	* @return 	boolean 	Whether or not the user is logged in or not.
	**/
	public static function isLogged() {
		return isset($_SESSION['auth_username']);
	}

	/**
	* Gets the username that the user is logged in as.
	*
	* @access 	public
	* @return 	string|false 	The username of the user. Returns null if the user isn't logged in.
	**/
	public static function getUsername() {
		if(isset($_SESSION['auth_username'])) {
			return $_SESSION['auth_username'];
		} else {
			return false;
		}

	}

}