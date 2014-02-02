<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @link 	http://blogza.net
* @version	0.6
**/
class Blogza {

	protected $settings;

	protected $modelmanager;
	protected $errorhandler;
	protected $databasemanager;

	protected $router;

	public static $start;

	/**
	* Creates the Blogza instance. This class is the controller for the entire blog.
	*
	* @access 	public
	* @return 	Blogza
	**/
	public function __construct() {
		// Records the program start time.
		self::$start = microtime();

		// Starts our session.
		session_start();

		// Requires all the necessary files.
		if(!file_exists(BLOGZA_DIR . "/system/settings.php")) {
			$content = file_get_contents(BLOGZA_DIR . "/system/settings.default.php");
			file_put_contents(BLOGZA_DIR . "/system/settings.php", $content);
		}
		require BLOGZA_DIR . "/system/settings.php";

		require BLOGZA_DIR . "/system/views/View.php";
		require BLOGZA_DIR . "/system/controllers/Controller.php";
		require BLOGZA_DIR . "/system/models/Model.php";

		require BLOGZA_DIR . "/system/routing/Router.php";
		
		require BLOGZA_DIR . "/system/models/Util.php";
		require BLOGZA_DIR . "/system/models/Auth.php";
		require BLOGZA_DIR . "/system/models/Post.php";
		require BLOGZA_DIR . "/system/models/User.php";
		require BLOGZA_DIR . "/system/models/Comment.php";
		require BLOGZA_DIR . "/system/models/Mail.php";

		require BLOGZA_DIR . "/system/processors/Markup.php";
		require BLOGZA_DIR . "/system/processors/Minify.php";

		require BLOGZA_DIR . "/system/protection/CSRFHandler.php";
		require BLOGZA_DIR . "/system/protection/CAPTCHAHandler.php";

		require BLOGZA_DIR . "/system/packages/Database.class.php";
		
		require BLOGZA_DIR . "/system/controllers/ErrorHandler.php";

		require BLOGZA_DIR . "/system/etc/Statistics.php";
	}

	/**
	* Starts the Blogza web-interface.
	*
	* @access 	public
	* @return 	void
	**/
	public function start() {
		// Settings
		$this->settings = new Settings();

		// ErrorHandler
		$this->errorhandler = new ErrorHandler();

		// Router
		$this->router = new Router();

		// Get the routes.
		require BLOGZA_DIR . "/system/routes.php";

		// Settle the route.
		list($class, $method) = explode("@", $this->router->go());

		// Require the $file for the controller and create the $class.
		require BLOGZA_DIR . "/system/controllers/" . $class . ".php";
		$controller = new $class($this->router->getMatchedExpressions());

		// Run the method.
		$controller->$method();


		// Called after the website loads.
		Statistics::generate();
	}

}