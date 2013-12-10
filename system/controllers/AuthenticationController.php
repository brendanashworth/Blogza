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
		if(Auth::isLogged()) Util::redirect(BLOG_URL);

		$error = null;
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordrepeat'])) {
			// Check for CSRF first, then complete registration.
			if(!CSRFHandler::check()) {
				$error = "CSRF token is missing; if this is in error, contact the blog administrator.";
			} else {

				try {
					// Register now; don't forget to catch the errors.
					User::register($_POST['username'], $_POST['password'], $_POST['passwordrepeat'], $_POST['email'], true);
				} catch (Exception $ex) {
					$error = $ex->getMessage();
				}

			}
		}

		$view = BLOGZA_DIR . "/system/views/Register.view.php";

		CSRFHandler::generate();
		$posts = array_reverse(Database::getPosts());

		require $view;
	}

	/**
	* Controller method for the /login/ route.
	*
	* @access 	public
	* @return 	void
	**/
	public function login() {
		if(Auth::isLogged()) Util::redirect(BLOG_URL);

		$error = false;
		if(isset($_POST['username']) && isset($_POST['password'])) {
			// Check for CSRF.
			if(!CSRFHandler::check()) {
				$error = "CSRF token is missing; if this is in error, contact the blog administrator.";
			} else {

				// The login form has been filled in.
				try {
					User::login($_POST['username'], $_POST['password']);
				} catch (Exception $ex) {
					$error = $ex->getMessage();
				}
			}
		}

		$view = BLOGZA_DIR . "/system/views/Login.view.php";

		CSRFHandler::generate();
		$posts = array_reverse(Database::getPosts());

		require $view;
	}

	/**
	* Runs a login attempt for the user.
	*
	* @access 	public
	* @return 	void
	**/
	public function logout() {
		Auth::logout();

		Util::redirect(BLOG_URL . "/");
	}

}