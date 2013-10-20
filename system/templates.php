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
	public function __construct($blogza, $template = "default") {
		$this->blogza = $blogza;

		$this->loadTemplate($template);
	}

	/**
	* Loads the template from the files.
	*
	* @access	private
	* @return	void
	**/
	private function loadTemplate($template) {
		$location = __DIR__.'/../templates/'.$template.'/';

		// Go through the routes system to grab the necessary files.
		foreach($this->blogza->getRoutes()->home as $page) {
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

			$postID = $post["id"];

			// Format these. {post-ID-author}, {post-ID-title}, {post-ID-content}
			$replaceables["{post-".$postID."-author}"] = $author;
			$replaceables["{post-".$postID."-title}"] = $title;
			$replaceables["{post-".$postID."-content}"] = $content;
		}

		foreach($replaceables as $key => $value) {
			$this->page = str_replace($key, $value, $this->page);
		}
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