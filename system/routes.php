<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Routes {

	private $blogza;

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
	* @param	blogza	$blogza 	The Blogza instance for the blog
	* @return	void
	**/
	public function __construct($blogza) {
		$this->blogza = $blogza;
	}

	/**
	* Prepares the Router.
	*
	* @access 	public
	* @return 	void
	**/
	public function prepareRouter() {
		//ToroHook::add('404', function() { echo "404 error."; } );

		echo "1";
		foreach($this->routes as $route => $pages) {
			echo $route."<br />";
			Router::addRoute($route, $pages);
			echo "passed";
		}
		echo "2";

		Router::go();
		//Toro::serve($array);
	}

}