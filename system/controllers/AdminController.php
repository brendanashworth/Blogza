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
		$posts = array_reverse(Database::getPosts());
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

			$content = str_replace("\n", "[BR]", $content); // Replace line breaks with Markup breaks.

			Database::createPost(Auth::getUsername(), $title, $content);
			echo "Post created.";
		} else {
			echo "You are missing one or two fields.";
		}
	}

	/**
	* Gets the post. This is an Ajax / POST only feature.
	*
	* @access 	public
	* @return 	void
	**/
	public function getPost() {
		if(!empty($_POST['id'])) {
			$id = $_POST['id'];

			if(!is_numeric($id)) {
				echo "Post ID must be numeric.";
			} else {
				// Now we get the Post.

				$post = Database::getPost($id);
				$markup = new Markup();

				$content = $markup->processBackwards($post->content);
				$content = str_replace("[BR]", "\n", $content);

				echo $content;
			}
		} else {
			echo "JS Error: Missing Post ID.";
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
				echo "Your comment ID is not numeric.";
			} else {
				Database::updateCommentApproved($id, $value);
				echo "Approved to $value correctly.";
			}

		} else {
			echo "JS Error: Missing one or two fields.";
		}

	}

	/**
	* Updates a post's status, content, and title. This is an Ajax / POST only feature.
	*
	* @access 	public
	* @return 	void
	**/
	public function updatePost() {
		if(!empty($_POST['content']) && !empty($_POST['id'])) {
			$id = $_POST['id'];
			$content = $_POST['content'];

			$content = str_replace("\n", "[BR]", $content); // Replace line breaks with Markup breaks.

			Database::updatePost($id, $content);
			echo "Post updated.";
		} else {
			echo "You are missing one or two fields.";
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