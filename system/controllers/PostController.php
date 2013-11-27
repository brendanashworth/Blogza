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
			die("404 todo PostController.php #1");
		}

		require $view;
	}

	public function viewComments() {
		if(Auth::isLogged() && isset($_POST['comment'])) {
			die("make post.");
		}

		$view = BLOGZA_DIR . "/system/views/ViewComments.view.php";

		$id = $this->matched[2];
		$post = Database::getPost($id);
		$posts = array_reverse(Database::getPosts());

		if($post == null) {
			die("404 todo PostController.php #2");
		}

		$comments = Database::getComments($id);

		require $view;
	}

}