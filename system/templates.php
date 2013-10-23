<?php

class TemplateManager {

	private $page;
	private $blogza;

	/**
	* Creates the TemplateManager instance.
	*
	* @param	string	$template	The name of the template file to use.
	* @return	void
	**/
	public function __construct($blogza) {
		$this->blogza = $blogza;

		//$this->loadTemplate($template);
	}

	/**
	* Loads the template from the files.
	*
	* @access	public
	* @return	void
	**/
	public function loadTemplate($pages, $template = "default") {
		$location = __DIR__.'/../templates/'.$template.'/';

		// Go through the routes system to grab the necessary files.
		foreach($pages as $page) {
			$this->page = $this->page . file_get_contents($location.$page);
		}

		$this->processPage();
	}

	/**
	* Processes the page. This includes changing all variables to their specified values.
	*
	* @return	void
	**/
	private function processPage() {

		/* An array of settings and values to change. */
		$replaceables = array(
			"{blog-name}" => BLOG_NAME,
			"{blog-description}" => BLOG_DESC,
			// Custom variables
			"{date}" => date("M-D-Y"),
			"{date-year}" => date("Y"),
			);

		/* Now lets retrieve all the posts */
		$posts = $this->blogza->getDatabaseManager()->getPosts(); // Gets all the posts.

		foreach($posts as $post) {
			// Now for each post.
			$author = $post["author"];
			$title = $post["title"];
			$content = $post["content"];
			$link = $post["link"];
			$postID = $post["id"];

			// Format these. {post-ID-author}, {post-ID-title}, {post-ID-content}, {post-ID-link}
			$replaceables["{post-".$postID."-author}"] = $author;
			$replaceables["{post-".$postID."-title}"] = $title;
			$replaceables["{post-".$postID."-content}"] = $content;
			$replaceables["{post-".$postID."-link}"] = $link;
		}

		foreach($replaceables as $key => $value) {
			$this->page = str_replace($key, $value, $this->page);
		}

		$this->displayPage();
	}

	/**
	* Displays the page.
	*
	* @return	void
	**/
	public function displayPage() {
		echo $this->page;
	}
	
}