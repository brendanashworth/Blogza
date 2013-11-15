<?php

/**
* The Router, used for locating the correct route for the software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Router {

	protected $routes = array();
	protected $matched;

	/**
	* Creates the Router instance.
	*
	* @access 	public
	* @return 	Router
	**/
	public function __construct() {

	}

	/**
	* Creates a Route for the Router. Usage as follows:
	* $router->request('/path', 'Controller@Method')
	*
	* @access 	public
	* @param 	string 	$method 	The HTTP request type.
	* @param 	array 	$args 		The array of arguments; $args[0] is the path, $args[1] is the Controller / method.
	* @return 	void
	**/
	public function __call($method, $args) {
		if(count($args) !== 2) {
			throw new Exception("There must be exactly two arguments; a path and a controller / method relationship.");
		}

		list($path, $rel) = $args;

		$this->routes[$method][$path] = $rel;
	}

	/**
	* Adds a route to the Router.
	*
	* @deprecated
	*
	* @access 	public
	* @param 	string 	$route 	The route to be added.
	* @param 	class 	$model 	The model used to get the page.
	* @return 	bool 	Whether or not the add succeeded.
	**/
	public function addRoute($method = "get", $route = null, $controller = null){
		if($route == null || $controller == null) {
			throw new Exception("The Route or Controller cannot be null!");
		}

		$this->routes[$route] = $controller;
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
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $routes = empty($this->routes[$method]) ? array() : $this->routes[$method];

        // Merge the 'any' routes and $method routes. $method routes take precedence.
		foreach($this->routes['any'] as $key => $value) {
			if(array_key_exists($key, $routes)) {
				continue;
			}

			$routes[$key] = $value;
		}

		// Checks to find which route is which.
		foreach($routes as $route => $controller) {
	        // Now we check whether this is the correct page.
	        if($path == $route) {
	        	return $controller;
	        } else if (preg_match('#^/?' . $route . '/?$#', $path, $matches)) {
	        	$this->matched = $matches;
	        	return $controller;
	        }

		}

        return $this->routes['any']['404'];
	}

	/**
	* Gets the matched expressions from the go() method.
	*
	* @access 	public
	* @return 	array
	**/
	public function getMatchedExpressions() {
		return $this->matched;
	}
}