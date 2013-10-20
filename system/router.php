<?php

class Router {

	private $methods;
	private $path;
	private $params = array();

	/**
	 * Instantiates the router. Takes a path parameter, otherwise falls back
	 * on $_GET['p']
	 *
	 * @param 	string	$path
	 * @return	void
	 */
	public function __construct($path = null) {
		$this->path = $path ? $path : $_GET['p'];
	}

	/**
	 * Handles route creation. Call it like $route->method($path, $function).
	 * For example, $route->get('/home', function(){ echo "Hello World!"; });
	 *
	 * @param 	string	$method 	HTTP method
	 * @param 	array 	$arguments 	Should be exactly two arguments. First the
	 * 								path, second a callable.
	 * @return	void
	 */
	public function __call($method, $arguments) {
		if (count($arguments) !== 2) {
			throw new Exception('Undefined Router method ' . $method);
		}

		list($path, $function) = $arguments;

		$this->methods[strtolower($method)][$path] = $function;
	}

	/**
	 * Executes the routes
	 *
	 * @return	mixed
	 */
	public function go() {

		$reqArray = $this->getRequestArray();
		if (!$exec = $this->pather($reqArray)) {
			return false;
		}

		return call_user_func_array($exec, $this->params);
	}

	/**
	 * Finds paths for the current request method
	 *
	 * @return	array
	 */
	private function getRequestArray() {
		$method = strtolower($_SERVER['REQUEST_METHOD']);

		if (!array_key_exists($method, $this->methods)) {
			return array();
		}

		return $this->methods[$method];
	}

	/**
	 * Big ol' function to parse and match the paths, returning the callable
	 * given in the route. 
	 *
	 * @param 	array 		$paths
	 * @return	callable|boolean
	 */
	private function pather($paths) {
		$urlParts = explode('/', trim($this->path, '/'));
		foreach ($paths as $path => $function) {

			$this->params = array();
			$pathParts = explode('/', trim($path, '/'));
			
			foreach ($pathParts as $key => $match) {
				if (preg_match('/{\\?[A-z0-9]+}/', $match)) {
					$this->params[] = array_key_exists($key, $urlParts) ? $urlParts[$key] : null;
					continue;
				}
				if (!array_key_exists($key, $urlParts)) {
					continue 2;
				}
				$urlPart = $urlParts[$key];
				if ($urlPart == $match) {
					continue;
				}
				if (preg_match('/{[A-z0-9]+}/', $match)) {
					if (array_key_exists($key, $urlParts)) {
						$this->params[] = $urlPart;
						continue;
					} else {
						continue 2;
					}
				}
			}

			return $function;
		}

		return false;
	}

}