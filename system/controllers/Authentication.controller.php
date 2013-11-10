<?php

/**
* Authentication class.
**/
class AuthenticationController extends Controller {

	/**
	* Creates the Authentication controller.
	*
	* @access 	public
	* @return 	Authentication
	**/
	public function __construct() {
		require BLOGZA_DIR . "/system/models/User.php";
	}

	/**
	* Controller method for the /register/ route.
	*
	* @access 	public
	* @return 	void
	**/
	public function register() {
		$error = null;
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordrepeat'])) {
			try {
				User::register($_POST['username'], $_POST['password'], $_POST['passwordrepeat']);
			} catch (Exception $ex) {
				$error = $ex->getMessage();
			}
		}

		$view = BLOGZA_DIR . "/system/views/Register.view.php";
		require $view;
	}

	/**
	* Controller method for the /login/ route.
	*
	* @access 	public
	* @return 	void
	**/
	public function login() {
		$error = false;
		if(isset($_POST['username']) && isset($_POST['password'])) {
			// The login form has been filled in.
			try {
				User::login($_POST['username'], $_POST['password']);
			} catch (Exception $ex) {
				$error = $ex->getMessage();
			}
		}

		$view = BLOGZA_DIR . "/system/views/Login.view.php";
		require $view;
	}

	public function logout() {
		Auth::logout();

		Util::redirect(BLOG_URL . "/");
	}

}