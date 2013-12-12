<?php

/**
* Statistics class.
**/
class Statistics {

	/**
	* Generates the Blog's statistics.
	*
	* @access 	public
	* @return 	void
	**/
	public static function generate() {
		$ip = $_SERVER['REMOTE_ADDR'];

		if(Auth::isLogged()) {
			Database::addUserIP(Auth::getUsername(), $ip);
		}
	}

}