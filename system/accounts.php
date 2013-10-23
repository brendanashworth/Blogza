<?php

class AccountManager {

	private $name;

	/**
	* Creates the AccountManager instance.
	*
	* @access	public
	* @return	AccountManager
	**/
	public function __construct() {
		$this->who();
	}

	/**
	* Initial check-ins for the user.
	*
	**/
	private function who() {
		// Is the user already logged in?
		if(isset($_SESSION) && isset($_SESSION['user']) {
			// Yes!
			
		} else {
			// No, and we don't have to do anything.
		}
	}


}