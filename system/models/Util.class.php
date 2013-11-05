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

	public static function kill($message = "An error has occurred.") {
		die($message);
	}


}