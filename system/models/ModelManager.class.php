<?php

namespace Models\ModelManager;

/**
* The ModelManager class, which appropriates the Routing and then the Models.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class ModelManager {

	protected $router;

	/**
	* Creates an instance of the ModelManager class.
	*
	* The ModelManager class is a class that, simply, manages all the models. This class is also responsible for the correct
	*  routing and route management, then selecting the correct Model to utilize for
	*
	* @access 	public
	* @return 	ModelManager
	**/
	public function __construct() {
		require "Router.class.php";
		$this->router = new Router();
	}

	/**
	* Prepares the ModelManager.
	*
	* This includes preparing the Router with the Models necessary.
	*
	* @access 	public
	* @return 	void
	**/
	public function prepare() {
		$this->prepareRouter();
	}

	/**
	* Launches the ModelManager class.
	*
	* This function begins by resolving the correct route and page the user accessed, then it gets the necessary data from 
	*  the correct model.
	*
	* @access 	public
	* @return 	void
	**/
	public function go() {
		$model = $this->router->go();
	}

	/**
	* Prepares the Router by adding all the Models and their routes.
	*
	* @access 	private
	* @return 	void
	**/
	private function prepareRouter() {
		$exempt = array(
			"ModelManager.class.php",
			"Router.class.php",
			"Model.interface.php",
			);

		// Iterate over all the files in this directory that end in .php
		$files = glob(__DIR__ . '*.php', GLOB_BRACE);
		foreach($files as $file) {
			// Is the file exempt?
			if(!in_array($file, $exempt)) {
				// It isn't, lets load it.
				include $file;

				// Now lets add the route.
				$route = $file->getRoute();
				
				$this->router->addRoute($route, $file);
			}
		}
	}

}