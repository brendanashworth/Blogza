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

		$comments = Database::getCommentsNotApproved();

		$view = BLOGZA_DIR . "/system/views/Admin.view.php";

		require $view;
	}

	/**
	* Creates the post. This is an Ajax / POST only feature.
	*
	* @access 	public
	* @return 	void
	**/
	public function createPost() {
		if(!empty($_POST['content']) && !empty($_POST['title'])) {
			// NEEDS SANITIZATION!
			$title = $_POST['title'];
			$content = $_POST['content'];

			Database::createPost(Auth::getUsername(), $title, $content);
			echo "Post created.";
		} else {
			echo "You are missing one or two fields.";
		}
	}

	/**
	* Updates a comment's moderated status. This is an Ajax / POST only feature.
	*
	* @access 	public
	* @return 	void
	**/
	public function updateComment() {

		if(!empty($_POST['value']) && !empty($_POST['comment_id'])) {
			$value = $_POST['value'];
			$value = Util::sanitizeAlphaNumerically($value);

			$id = $_POST['comment_id'];
			if(!is_numeric($id)) {
				Util::kill("Your comment ID is not numeric.");
			}

			Database::updateCommentApproved($id, $value);

			echo $value . " " . $id;
		}

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