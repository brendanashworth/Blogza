<?php

/**
* The ErrorHandler class, responsible for handling errors generated.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class ErrorHandler {

	/**
	* Creates the ErrorHandler.
	*
	* @access 	public
	* @return 	ErrorHandler
	**/
	public function __construct() {
		$this->setHandler();
	}

	/**
	* Handles an error.
	*
	* @access 	public
	* @param 	int 	errno 		The level of the error raised.
	* @param 	string 	errstring 	The error message of the error.
	* @param 	string 	errfile 	The file of which the error happened.
	* @param 	int 	errline 	The line in the file that the error happened.
	* @param 	array 	errcontext	The context in which the error occurred.
	**/
	public static function handle($errno, $errstring, $errfile, $errline, $errcontext = null) {
		$view = __DIR__ . "/../views/Exception.view.php";

		// Prepare the variables needed for the View, then start the View.
		require __DIR__ . "/../models/BlogzaException.class.php";
		$exception = new BlogzaException($errno, $errstring, $errfile, $errline, $errcontext);

		require $view;

		// exit out
		exit();
	}

	/**
	* Sets the error handler to the correct method.
	*
	* @access 	private
	* @return 	void
	**/
	private function setHandler() {
		// This mumble jumble simply tells it to run ErrorHandler::handle to the errors.
		set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context) {
			ErrorHandler::handle($err_severity, $err_msg, $err_file, $err_line, $err_context);
		} );
	}

}