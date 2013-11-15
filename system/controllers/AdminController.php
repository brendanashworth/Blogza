<?php

/**
* Admin controller
**/
class AdminController extends Controller {

	/**
	* Displays the 'hub board' for the Admin Controller.
	*
	* @access 	public
	* @return 	void
	**/
	public function index() {
		$posts = Database::getPosts();
		$users = Database::getUsers();

		$view = BLOGZA_DIR . "/system/views/Admin.view.php";

		require $view;
	}

	/**
	* Displays the create page if the form isn't filled out, if it is filled out, creates the post.
	*
	* @access 	public
	* @return 	void
	**/
	public function createPost() {

	}

	/**
	* Performs the authentication check on the user.
	*
	* @access 	public
	* @return 	void
	**/
	public function auth() {
		$rank = Auth::getRank();
		if($rank !== "Admin") {
			Util::redirect(BLOG_URL . "/login/");
		}
	}

}