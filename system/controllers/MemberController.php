<?php

/**
* MemberController, the class for the members directory and member view pages.
**/
class MemberController extends Controller {

	/**
	* Displays the index page for the MemberController.
	*
	* @access 	public
	* @return 	void
	**/
	public function index() {
		$view = BLOGZA_DIR . "/system/views/Members.view.php";

		$users = Database::getUsers();

		require $view;
	}



}