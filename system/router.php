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

		$this->routes[$route] = $pages;
	}

	/**
	* Gets the path.
	*
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
    * @param    TemplateManager     $templatemanager    The TemplateManager class to load the template with.
	* @return 	void
	**/
	public function go($templatemanager) {
        if($templatemanager == null) {
            throw new Exception("The TemplateManager cannot be null!");
        }

    	// Method stolen from Toro, @author anandkunal
        $path = Router::getPath();

        $displayPages = null;

		// Checks to find which route is which.
		foreach($this->routes as $route => $pages) {

	        // Now we check whether this is the correct page.
	        if($path == $route) {
	        	$displayPages = $pages;
	        	break;
	        }/* else {
	        	// Try and fit the path into the route via patterns.
	        	$keys = array(
	        		":number" => "([0-9]+)",
	        		);

	        	$necessary = 0;
	        	$found = 0;

	        	foreach($keys as $key => $pattern) {
	        		// Does the route contain the pattern?
	        		if(strpos($route, $key)) {
	        			$necessary++;
	        			echo "DEBUG: Route $route contains key $key. <br />";

	        			list($prestring, $afterstring) = explode($key, $route);
	        			echo $prestring . $pattern . $afterstring ." * ". $path . "<br />";

	        			if( preg_match(  $prestring . $pattern . $afterstring , $path) ) {
	        				echo "DEBUG: Seems to have worked. #74 comes in fine. <br />";
	        				$found = 0;
	        			} else {
	        				echo "DEBUG: Did not pass, #78. <br />";
	        			}
	        		}
	        	}

	        	// Did the pattern matcher work?
	        	if($necessary == $found && $necessary !== 0) {
	        		echo "DEBUG: Reaches #83. <br />";
	        		$pageFound = true;
	        	}
	        }*/
		}

        if($displayPages != null) {
        	/* Page found, display it. */
        	$templatemanager->loadTemplate($pages, BLOG_TEMPLATE);
        } else {
        	/* 404 Error, not found. */
        	$pages = $this->routes['404'];
            $templatemanager->loadTemplate($pages, BLOG_TEMPLATE);
        }
	}
}