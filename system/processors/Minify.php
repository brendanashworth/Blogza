<?php

/**
* Minify class, used to remove extraneous stuff from files.
**/
class Minify {

	private $cssReplace = array(
		"/\n+/" => "", // New lines
		"/\t+/" => "", // Tabs
		"!/\*.*?\*/!s" => "", // Comments
		"/ +/" => " ", // Multiple spaces
		"/ > /" => ">", // CSS selector > removes extraneous speed
		"/; /" => ";", // Remove space after semicolon
		"/: /" => ":", // Remove space after colon
		);

	private $jsReplace = array(
		"/\n+/" => "", // New lines
		"/\t+/" => "", // Tabs
		"!/\*.*?\*/!s" => "", // Comments
		"/ +/" => " ", // Multiple spaces
		);

	/**
	* Constructs the Minify object.
	*
	* @access 	public
	* @return 	void
	**/
	public function __construct() {

	}

	/**
	* Minifies the file given. Uses CSS syntax for minification.
	*
	* @access 	public
	* @param 	string 	$file 	The file to minify.
	* @return 	string 	The minified file.
	**/
	public function minifyCSS($file) {
		foreach($this->cssReplace as $regex => $replace) {
			$file = preg_replace($regex, $replace, $file);
		}

		return $file;
	}

	/**
	* Minifies the file given. Uses JS syntax for minification.
	*
	* @access 	public
	* @param 	string 	$file 	The file to minify.
	* @return 	string 	The minified file.
	**/
	public function minifyJS($file) {
		foreach($this->jsReplace as $regex => $replace) {
			$file = preg_replace($regex, $replace, $file);
		}

		return $file;
	}

}