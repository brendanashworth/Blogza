<?php

/**
* The Model for Posts.
**/
class Post extends Model {

	public $title;
	public $author;
	public $content;
	public $date;

	public $link;

	/**
	* Creates the Post instance. Note: This does not load the Post into the database.
	*
	* @access 	public
	* @param 	string 	$title 		The title of the post.
	* @param 	string 	$author 	The author of the post.
	* @param 	string 	$content 	The content of the post.
	* @param 	string 	$date 		The creation date of the post.
	* @param 	int 	$id 		The ID of the post. Defaults to null.
	* @return 	Post
	**/
	public function __construct($title, $author, $content, $date, $id) {
		$this->title = $title;
		$this->author = $author;
		$this->content = $content;
		$this->date = $date;

		$this->link = empty($id) ? null : "/post/" . $id;
	}

}