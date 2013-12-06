<?php

/**
* Controller for all the posts.
**/
class PostController extends Controller {

	public function index() {
		$view = BLOGZA_DIR . "/system/views/Home.view.php";

		$posts = array_reverse(Database::getPosts());

		require $view;
	}

	public function viewPost() {
		$view = BLOGZA_DIR . "/system/views/ViewPost.view.php";

		$id = $this->matched[2];
		$post = Database::getPost($id);
		$posts = array_reverse(Database::getPosts());

		if($post == null) {
			Util::abort(404);
		}

		require $view;
	}

	public function viewComments() {
		if(Auth::isLogged() && isset($_POST['content'])) {
			$post = $this->matched[2];
			$author = Auth::getUsername();
			$content = $_POST['content'];

			Database::createComment($post, $author, $content);
		}

		$view = BLOGZA_DIR . "/system/views/ViewComments.view.php";

		$id = $this->matched[2];
		$post = Database::getPost($id);
		$posts = array_reverse(Database::getPosts());

		if($post == null) {
			Util::abort(404);
		}

		$comments = Database::getComments($id);

		require $view;
	}

}