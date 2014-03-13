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
			} else if (!CAPTCHAHandler::check()) {
				$error = "Incorrect CAPTCHA, please try again.";
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
				//set how long we want them to have to wait after 5 wrong attempts
				$blocktime = 5; //make them wait 5 mins
				
				//check if user failed login more than 4 times and block time didn't expire yet
		        	if(isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] > 4 && $_SESSION['failed_attempt'] >= time())
		            		$this->view->setAlert("Login temporarily blocked for ".$blocktime." minutes!");
		            	else{
					// The login form has been filled in.
					try {
						User::login($_POST['username'], $_POST['password']);
					} catch (Exception $ex) {
						//add a fail attempt and set the time it expires
						//set how long we want them to have to wait after 5 wrong attempts
						$time = 305; //make them wait 5 mins
						if(isset($_SESSION['failed_attempts']))
							++$_SESSION['failed_attempts']; 
						else
							$_SESSION['failed_attempts'] = 1;
						$_SESSION['failed_attempt'] = time() + $blocktime * 60;
						$error = $ex->getMessage();
					}
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
