<?php

/**
* The BlogException class, passed to the Exception view.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class BlogzaException {

	public $err_level;
	public $err_msg;
	public $err_file;
	public $err_line;
	public $err_context;

	public $err_file_lines;

	/**
	* Creates a BlogzaException.
	*
	* @access 	public
	* @param 	int 	err_level 	The level of the error raised.
	* @param 	string 	err_msg 	The error message of the error.
	* @param 	string 	err_file 	The file of which the error happened.
	* @param 	int 	err_line 	The line in the file that the error happened.
	* @param 	array 	err_context	The context in which the error occurred.
	* @return 	BlogzaException
	**/
	public function __construct($err_level, $err_msg, $err_file, $err_line, $err_context) {
		$this->err_level   = $err_level;
		$this->err_msg     = $err_msg;
		$this->err_file    = $err_file;
		$this->err_line    = $err_line;
		$this->err_context = $err_context;

		$this->err_file_lines = file($err_file, FILE_IGNORE_NEW_LINES);
	}


}