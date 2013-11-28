<?php

/**
* Util, the class used for basic utilities for the software.
*
* @author	boboman13 <me@boboman13.net>
* @link 	http://blogza.net
**/
class Util {

	/**
	* The constructor, made private to prevent creations.
	*
	* @access 	private
	**/
	private function __construct() {

	}

	/**
	* Aborts the running application and displays an error page.
	*
	* @access 	public
	* @param 	mixed 	$id 	The type of error that occurred.
	* @return 	void
	**/
	public static function abort($id) {
		switch ($id) {

			case 1:
				Util::kill("MySQL connection error has occurred.");
				break;

			case 404:
				Util::header("HTTP/1.0 404 Not Found");
				Util::kill("404 error, page not found.");
				break;

		}
	}

	/**
	* Redirect the user to the URL given.
	*
	* @access 	public
	* @param 	string 	$url 	The URL to redirect to.
	* @return 	void
	**/
	public static function redirect($url) {
		header("Location: " . $url);
	}

	/**
	* Set the content type.
	*
	* @access 	public
	* @param 	string 	$content 	The type of content used.
	* @return 	void
	**/
	public static function setContent($content) {
		header("Content-type: " . $content);
	}

	/**
	* Sets a new header.
	*
	* @access 	public
	* @param 	string 	$content 	The header to add.
	* @return 	void
	**/
	public static function header($content) {
		header($content);
	}

	/**
	* Kills the program.
	*
	* @access 	public
	* @param 	string 	$message 	The message to kill the program with.
	* @return 	void
	**/
	public static function kill($message = "An error has occurred.") {
		die($message);
	}

	/**
	* Sanitizes the given string to alpha-numeric characters only.
	*
	* This method also contains some more generic cleansing, even though it isn't necessary.
	*
	* @access 	public
	* @param 	string 	$string 	The string to cleanse.
	* @return 	string 	The cleansed and sanitized string.
	**/
	public static function sanitizeAlphaNumerically($string) {
		$string = stripcslashes($string);
		$string = trim($string);

		$string = preg_replace("/[^a-zA-Z0-9]+/", "", $string);

		$string = trim($string);

		return $string;
	}

	/**
	* Sanitizes a user email.
	*
	* @access 	public
	* @param 	string 	$string 	The string to sanitize into an email.
	* @return 	bool 	Whether or not the email is safe.
	**/
	public static function sanitizeEmail($string) {
		$bool = filter_var($string, FILTER_SANITIZE_EMAIL);

		if(!$bool) {
			return false;
		}

		$strings = explode('@', $string);
		if(substr_count($string, '@') != 1) {
			return false;
		}

		if(substr_count($strings[1], '.') != 1) {
			return false;
		}

		return true;
	}

	/**
	* Hashes the given password based on the software's default hash.
	*
	* @access 	public
	* @param 	string 	$pass 	The string which the software wants hashed.
	* @return 	string 	The hashed password.
	**/
	public static function hashPassword($pass) {
		// Iterate the password over a sha256 hash 16 times.
		for($i = 0; $i < 16; $i++) {
			$pass = hash('sha256', $pass);
		}
		return $pass;
	}

}