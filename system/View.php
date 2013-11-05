<?php

/**
* View class, used for managing Views and loading Template files.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class View {

	private $page;
	private $template;
	protected $dir;

	/**
	* Creates the TemplateManager instance.
	*
	* @access 	public
	* @return	void
	**/
	public function __construct($template = "default") {
		if($template == null) {
			throw new Exception("The template cannot be null!");
		}

		$this->template = $template;
		$this->dir = __DIR__.'/templates/'.$template.'/';
	}

	/**
	* Loads a page into the cache.
	*
	* @access	public
	* @param 	array 	$page 		The page that should be loaded.
	* @return	void
	**/
	public function loadPage($page) {
		$fileinfo = pathinfo($this->dir . $page);

		if($fileinfo['extension'] == "php") {
			// Ends in .php, have to load it as a .php file.
			ob_start();
			require($this->dir . $page);
			$this->page .= ob_get_clean();
			ob_end_clean();
		} else {
			// Ends in something else, we can't filter it.
			$this->page .= file_get_contents($this->dir . $page);
		}
			
	}

	/**
	* Processes the page. This includes changing all variables to their specified values.
	*
	* @access 	public
	* @return	void
	**/
	public function processPage() {

		/* An array of settings and values to change. */
		$replaceables = array(
			"{blog-name}" => BLOG_NAME,
			"{blog-description}" => BLOG_DESC,
			"{blog-url}" => BLOG_URL,
			"{template-name}" => $this->template,
			// Custom variables
			"{date}" => date("M-D-Y"),
			"{date-year}" => date("Y"),
			);

		/* Now lets retrieve all the posts */
		$posts = Database::getPosts(); // Gets all the posts.

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
	public function displayPage() {
		echo $this->page;
	}
	
}