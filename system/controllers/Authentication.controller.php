<?php

/**
* Authentication class.
**/
class AuthenticationController extends Controller {

	/**
	* Controller method for the /register/ route.
	*
	* @access 	public
	* @return 	void
	**/
	public function register() {
		require BLOGZA_DIR . "/system/models/User.php";

		$error = null;
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordrepeat'])) {
			try {
				User::register($_POST['username'], $_POST['password'], $_POST['passwordrepeat'], false);
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
		require BLOGZA_DIR . "/system/models/User.php";

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