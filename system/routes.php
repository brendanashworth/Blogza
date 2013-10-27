<?php

/* Welcome to Blogza! Blogza is an open source blogging software, designed to
 *  1) Allow customization down to the hard HTML
 *  2) Keep blogging simple and easy
 *  3) Keep setup fast and simple
 *
 * We hope you enjoy the software! - boboman13
 */

class Routes {

	private $blogza;
	
	public $routes = array(
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
	* @param	blogza	$blogza 	The Blogza instance for the blog
	* @return	void
	* @access	public
	**/
	public function __construct($blogza) {
		$this->blogza = $blogza;
	}

	public function prepareRouter() {
		$array = array();
		foreach($this->routes as $route => $value) {
			$array[$route] = "TemplateManager";
		}

		Toro::serve($array);
	}

}