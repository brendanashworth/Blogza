<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Router {
	private $routes = array();

	/**
	* Adds a route to the Router.
	*
	* @access 	public
	* @param 	string 	$route 	The route to be added.
	* @param 	array 	$pages 	Pages to be shown upon route usage.
	* @return 	bool 	Whether or not the add succeeded.
	**/
	public function addRoute($route = null, $pages = null){
		if($route == null || $pages == null) {
			throw new Exception("The Route or Pages cannot be null!");
		}

		echo "Route #2: ".$route."<br />";
		$this->routes[$route] = $pages;
	}

	/**
	* Tells the Router to go.
	*
	* @access 	public
    * @param    TemplateManager     $templatemanager    The TemplateManager class to load the template with.
	* @return 	void
	**/
	public function go($templatemanager) {
        $pageFound = false;
		// Checks to find which route is which.
		foreach($this->routes as $route => $pages) {

			// Method stolen from Toro, @author anandkunal
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
	        echo "DEBUG: \$path=".$path."<br />";

			if($path == $route) {
                $pageFound = true;

				$templatemanager->loadTemplate($pages, BLOG_TEMPLATE);
			}
		}
        if(!$pageFound) {
            // The page was not found.
            echo "404 error.";
        }
	}
}