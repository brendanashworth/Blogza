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

	/**
	* Creates the Routes instance.
	*
	* @param	blogza	$blogza The Blogza instance for the blog
	* @return	void
	* @access	public
	**/
	public function __construct($blogza) {
		$this->blogza = $blogza;
	}

	public $routes = array(
		"/home" => array(
			"header.html",
			"sidebar.html",
			"homebody.html",
			"footer.html",
			),
		"/post/{?id}" => array(
			"header.html",
			"body.html",
			"footer.html",
			),
		);

	public function prepareRouter() {
		foreach($this->routes as $route => $value) {
			
			$this->blogza->getTemplateManager()->loadTemplate($value);

			Router::post($route, function() use ($value) {
				echo "called.";
				$this->blogza->getTemplateManager()->loadTemplate($value);
			} );
		}
	}

}