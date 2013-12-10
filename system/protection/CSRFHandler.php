<?php

/**
* CSRFHandler, the handler for anti-CSRF precautions.
**/
class CSRFHandler {

	private static $key;

	/**
	* Generates a CSRF key and assigns it to $_SESSION['CSRF_KEY'].
	*
	* @access 	public
	* @return 	void
	**/
	public static function generate() {
		$key = "";

		for ($i = 0; $i < 30; $i++) {
			$key .= rand(0, 9);
		}

		$key = md5($key);

		$_SESSION['CSRF_KEY'] = $key;
		self::$key = $key;

		return $key;
	}

	/**
	* Checks the CSRF token based on the previous set key.
	*
	* @access 	public
	* @return 	bool 	Whether or not the user is validated.
	**/
	public static function check() {
		if(empty($_POST['csrf_token']) || empty($_SESSION['CSRF_KEY'])) {
			return false;
		}

		if($_POST['csrf_token'] !== $_SESSION['CSRF_KEY']) {
			return false;
		}

		return true;
	}


}