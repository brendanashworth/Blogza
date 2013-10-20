<?php

class TemplateManager {

	public $page;
	private $blogza;

	/**
	* Creates the TemplateManager instance.
	*
	* @param template The name of the template file to use.
	*
	**/
	public function __construct($blogza, $template = "default") {
		$this->blogza = $blogza;

		$this->loadTemplate($template);
	}

	/**
	* Loads the template from the files.
	*
	* @access private
	**/
	private function loadTemplate($template) {
		$location = __DIR__.'/../templates/'.$template.'/';

		// First the header
		$this->page = $this->page . file_get_contents($location.'header.html');

		// Then the sidebar
		$this->page = $this->page . file_get_contents($location.'sidebar.html');

		// Then the body

		// Lastly, the footer

		$this->processPage();
	}

	/**
	* Processes the page. This includes changing all variables to their specified values.
	*
	* @access private
	**/
	private function processPage() {

		/* An array of settings and values to change. */
		$replaceables = array(
			"{blog-name}" => BLOG_NAME,
			"{blog-description}" => BLOG_DESC,
			);

		/* Now lets retrieve all the posts */
		$posts = $this->blogza->getDatabaseManager()->getPosts(); // Gets all the posts.

		foreach($posts as $post) {
			// Now for each post.
			$author = $post["author"];
			$title = $post["title"];
			$content = $post["content"];

			$postID = $post["id"];

			// Format these.
			$replaceables["{post-".$postID."-author}"] = $author;
			$replaceables["{post-".$postID."-title}"] = $title;
			$replaceables["{post-".$postID."-content}"] = $content;
		}

		foreach($replaceables as $key => $value) {
			$this->page = str_replace($key, $value, $this->page);
		}

		// Display the page.
		$this->displayPage();
	}

	/**
	* Displays the page.
	*
	* @access private
	**/
	private function displayPage() {
		echo $this->page;
	}
	
}