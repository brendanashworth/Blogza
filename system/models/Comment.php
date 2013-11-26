<?php

/**
* A single instance of a Comment.
**/
class Comment {

	public $id;
	public $post;
	public $author;
	public $ismoderated;
	public $date;
	public $content;

	public function __construct($id, $post, $author, $ismoderated, $content, $date) {
		$this->id = $id;
		$this->author = $author;
		$this->ismoderated = $ismoderated;
		$this->content = $content;
		$this->date = $date;
	}

}