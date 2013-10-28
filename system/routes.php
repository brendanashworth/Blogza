<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Routes {

	private $router;

	private $routes = array(
	"/" => array(
		"header.html",
		"sidebar.html",
		"homebody.html",
		"footer.html",
		),
	"/post/:number" => array(
		"header.html",
		"body.html",
		"footer.html",
		),
	);

	/**
	* Creates the Routes instance.
	*
	* @access	public
	* @param	blogza	$router 	The Router instance.
	* @return	void
	**/
	public function __construct($router) {
		$this->router = $router;;
	}

	/**
	* Prepares the Router.
	*
	* @access 	public
	* @param 	TemplateManager 	$templatemanager 	The TemplateManager class to pass to the Router.
	* @return 	void
	**/
	public function prepareRouter($templatemanager) {

		foreach($this->routes as $route => $pages) {
			$this->router->addRoute($route, $pages);
		}

		$this->router->go($templatemanager);
	}

}