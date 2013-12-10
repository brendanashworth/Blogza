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

	/**
	* Views a specific member.
	*
	* @access 	public
	* @return 	void
	**/
	public function viewMember() {
		$view = BLOGZA_DIR . "/system/views/ViewMember.view.php";

		$user = Database::getUser($this->matched[2]);

		if($user == null) {
			die("404 MemberController@32");
		}

		require $view;
	}

	/**
	* Edits the member's information.
	*
	* @access 	public
	* @return 	void
	**/
	public function edit() {
		if(!Auth::isLogged()) Util::redirect(BLOG_URL . "/login/");

		do if(!empty($_POST['email'])) {
			// Anti-CSRF.
			if(!CSRFHandler::check()) {
				$error = "CSRF token missing from request; contact blog administrator if in error.";
				break;
			}

			$email = $_POST['email'];
			
			if(!Util::sanitizeEmail($email)) {
				$error = "That is not a valid email address.";
				break;
			}

			$users = Database::getUsers();
			foreach($users as $user) {
				if($user->getEmail() === $email) {
					$error = "That email is already in use.";
					break 2;
				}
			}

			Database::updateUserEmail(Auth::getUsername(), $email);
			$msg = "Your email has been updated.";
		} while (false);

		// We add the do / while (false) to allow breaking.
		do if(!empty($_POST['password']) || !empty($_POST['passwordrep'])) {
			// CSRF.
			if(!CSRFHandler::check()) {
				$error = "CSRF token missing from request; contact blog administrator if in error.";
				break;
			}

			if(empty($_POST['password']) || empty($_POST['passwordrep'])) {
				$error = "You must fill in both password fields.";
				break;
			} else if($_POST['password'] !== $_POST['passwordrep']) {
				$error = "Your passwords do not match.";
				break;
			}

			$password = Util::sanitizeAlphaNumerically($_POST['password']);

			if( !(strlen($password) > 5 && strlen($password) < 21) ) {
				$error = "Your password must be at least 5 characters and no more than 20.";
				break;
			}

			Database::updateUserPassword(Auth::getUsername(), $password);

			$msg = "Password updated correctly.";

		} while (false);

		$view = BLOGZA_DIR . "/system/views/EditAccount.view.php";

		CSRFHandler::generate();
		$user = Database::getUser(Auth::getUsername());

		require $view;
	}

}