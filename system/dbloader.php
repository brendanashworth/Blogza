<?php

class DatabaseManager {

	/**
	* Creates the DatabaseManager instance.
	*
	**/
	function __construct() {
		
	}

	/**
	* Gets all the posts in array format.
	*
	* @access public
	**/
	public function getPosts() {
		return array(
			"1" => array(
				"id" => 1,
				"author" => "boboman13",
				"title" => "This is a post title.",
				"content" => "Hello, and welcome to the blog!",
				),
			"2" => array(
				"id" => 2,
				"author" => "Author2",
				"title" => "Post #2",
				"content" => "content",
				),
			"3" => array(
				"id" => 3,
				"author" => "Author3",
				"title" => "Title Post #3",
				"content" => "content for #3",
				),
			);
	}
	
}