<?php

//namespace Models\Router;

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Router {

	protected $routes = array();

	/**
	* Creates the Router instance.
	*
	* @access 	public
	* @return 	Router
	**/
	public function __construct() {

	}

	/**
	* Adds a route to the Router.
	*
	* @access 	public
	* @param 	string 	$route 	The route to be added.
	* @param 	class 	$model 	The model used to get the page.
	* @return 	bool 	Whether or not the add succeeded.
	**/
	public function addRoute($route = null, $model = null){
		if($route == null || $model == null) {
			throw new Exception("The Route or Model cannot be null!");
		}

		$this->routes[$route] = $model;
	}

	/**
	* Gets the path.
	*
	* @author 	anandkunal (Stolen from Toro, thanks)
	* @access 	public
	* @return 	string 	The user's path.
	**/
	public static function getPath() {
		$path = '/';
        if (!empty($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        } else if (!empty($_SERVER['ORIG_PATH_INFO']) && $_SERVER['ORIG_PATH_INFO'] !== '/index.php') {
            $path = $_SERVER['ORIG_PATH_INFO'];
        } else {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $path = (strpos($_SERVER['REQUEST_URI'], '?') > 0) ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI'];
            }
        }

        return $path;
	}

	/**
	* Tells the Router to go.
	*
	* @access 	public
	* @return 	model 	The model used to control the page.
	**/
	public function go() {
        $path = Router::getPath();

		// Checks to find which route is which.
		foreach($this->routes as $route => $model) {

	        // Now we check whether this is the correct page.
	        if($path == $route) {
	        	return $model;
	        }

		}

        return null;
	}
}