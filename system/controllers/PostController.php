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

		if($post == null) {
			die("404 todo PostController.php@23");
		}

		$posts = Database::getPosts();

		require $view;
	}

}