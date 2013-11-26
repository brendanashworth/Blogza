<?php

/**
* Minify class, used to remove extraneous stuff from files.
**/
class Minify {

	/**
	* Constructs the Minify object.
	*
	* @access 	public
	* @return 	void
	**/
	public function __construct() {

	}

	/**
	* Minifies the file given.
	*
	* @access 	public
	* @param 	string 	$file 	The file to minify.
	* @return 	string 	The minified file.
	**/
	public function minify($file) {
		$file = str_replace("\n", "", $file);

		return $file;
	}

}