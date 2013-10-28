<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class TemplateManager {

	private $page;
	private $blogza;
	private $template;

	/**
	* Creates the TemplateManager instance.
	*
	* @access 	public
	* @param	Blogza 	$blogza 	The Blogza instance to use.
	* @return	void
	**/
	public function __construct($blogza) {
		$this->blogza = $blogza;
	}

	/**
	* Loads the template from the files.
	*
	* @access	public
	* @param 	array 	$pages 		The array of pages that are used to load the page needed.
	* @param 	string 	$template 	The name of the template to be used, defaults to "default".
	* @return	void
	**/
	public static function loadTemplate($pages, $template = "default") {
		echo "loading.";
		$this->template = $template;

		$location = __DIR__.'/../templates/'.$template.'/';

		// Go through the routes system to grab the necessary files.
		foreach($pages as $page) {
			$this->page .= file_get_contents($location.$page);
		}

		$this->processPage();
	}

	/**
	* Processes the page. This includes changing all variables to their specified values.
	*
	* @access 	private
	* @return	void
	**/
	private function processPage() {

		/* An array of settings and values to change. */
		$replaceables = array(
			"{blog-name}" => BLOG_NAME,
			"{blog-description}" => BLOG_DESC,
			"{template-name}" => $this->template,
			// Custom variables
			"{date}" => date("M-D-Y"),
			"{date-year}" => date("Y"),
			);

		/* Now lets retrieve all the posts */
		$posts = $this->blogza->getDatabaseManager()->getPosts(); // Gets all the posts.

		foreach($posts as $post) {
			$postID = $post['id'];
			$inverseID = (count($posts) - $postID) + 1;

			$replaceables["{post-".$postID."-author}"] = $post['author'];
			$replaceables["{post-".$postID."-title}"] = $post['title'];
			$replaceables["{post-".$postID."-content}"] = $post['content'];
			$replaceables["{post-".$postID."-link}"] = $post['link'];
			$replaceables["{post-".$postID."-date}"] = $post['date'];
			// Now do latest posts.
			$replaceables["{latest-".$inverseID."-author}"] = $post['author'];
			$replaceables["{latest-".$inverseID."-title}"] = $post['title'];
			$replaceables["{latest-".$inverseID."-content}"] = $post['content'];
			$replaceables["{latest-".$inverseID."-link}"] = $post['link'];
			$replaceables["{latest-".$inverseID."-date}"] = $post['date'];
		}

		foreach($replaceables as $key => $value) {
			$this->page = str_replace($key, $value, $this->page);
		}

		$this->displayPage();
	}

	/**
	* Displays the page.
	*
	* @access 	public
	* @return	void
	**/
	public function get() {
		echo $this->page;
	}
	
}