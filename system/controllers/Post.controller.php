<?php

/**
* Controller for all the posts.
**/
class PostController extends Controller {

	public function viewPost() {
		require BLOGZA_DIR . "/system/models/Post.php";

		$id = $this->matched[1];
		$post = Database::getPost($id);

		$view = BLOGZA_DIR . "/system/views/ViewPost.view.php";

		require $view;
	}

}