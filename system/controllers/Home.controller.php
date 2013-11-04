<?php

/**
* The Home class, responsible for displaying the home page.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Home implements Controller {

	public function __construct() {
		
	}

	public function start() {
		$view = __DIR__ . "/../views/Home.view.php";

		// Prepare the variables needed for the View, then start the View.


		require $view;
	}

	public function getRoute() {
		return "/";
	}

}