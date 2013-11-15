<?php

/**
* Controller for all the posts.
**/
class PostController extends Controller {

	public function index() {
		$view = BLOGZA_DIR . "/system/views/Home.view.php";

		$posts = Database::getPosts();

		require $view;
	}

	public function viewPost() {
		$view = BLOGZA_DIR . "/system/views/ViewPost.view.php";

		$id = $this->matched[1];
		$post = Database::getPost($id);
		$posts = Database::getPosts();

		require $view;
	}

}