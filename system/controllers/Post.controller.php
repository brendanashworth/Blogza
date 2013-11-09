<?php

/**
* Controller for all the posts.
**/
class PostController extends Controller {
	
	protected $matched;

	/**
	* Creates the PostController.
	*
	* @access 	public
	* @param 	array 	$matched 	Array of the matched regexes in the route.
	* @return 	PostController
	**/
	public function __construct($matched) {
		require BLOGZA_DIR . "/system/models/Model.php";
		require BLOGZA_DIR . "/system/models/Post.php";

		$this->matched = $matched;
	}

	public function viewPost() {
		$id = $this->matched[1];
		$post = Database::getPost($id);

		$view = BLOGZA_DIR . "/system/views/ViewPost.view.php";

		require $view;
	}

}