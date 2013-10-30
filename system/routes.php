<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Routes {

	private $router;
	private $blogza;

	private $routes = array(
	"/" => array(
		"header.html",
		"sidebar.html",
		"homebody.html",
		"footer.html",
		),
	"/login/" => array(
		"header.html",
		"sidebar.html",
		"login.html",
		"footer.html",
		),
	"/register/" => array(
		"header.html",
		"sidebar.html",
		"register.html",
		"footer.html",
		),
	"404" => array(
		"header.html",
		"404.html",
		"footer.html",
		),
	);

	/**
	* Creates the Routes instance.
	*
	* @access	public
	* @param	Router	$router 	The Router instance.
	* @param 	Blogza 	$blogza 	The Blogza instance.
	* @return	void
	**/
	public function __construct($router, $blogza) {
		$this->router = $router;
		$this->blogza = $blogza;
	}

	/**
	* Prepares the Router.
	*
	* @access 	public
	* @param 	TemplateManager 	$templatemanager 	The TemplateManager class to pass to the Router.
	* @return 	void
	**/
	public function prepareRouter($templatemanager = null) {
		if($templatemanager == null) {
			throw new Exception("The TemplateManager cannot be null!");
		}

		// This method adds all the posts into routes.
		$this->preparePosts();

		foreach($this->routes as $route => $pages) {
			$this->router->addRoute($route, $pages);
		}

		$this->router->go($templatemanager);
	}

	/* Private functions */

	/**
	* Prepares the routes with posts.
	*
	* @access 	private
	* @return 	void
	**/
	private function preparePosts() {
		$posts = $this->blogza->getDatabaseManager()->getPosts();

		$pages = array(
			"header.html",
			"sidebar.html",
			"viewpost.php",
			"footer.html",
			);

		foreach($posts as $id => $info) {
			$this->router->addRoute("/post/".$id, $pages);
		}
	}

}