<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Blogza {

	public static $name = 'Blogza';

	private $databasemanager;
	private $templatemanager;
	private $router;
	private $routes;

	/**
	* Creates the Blogza instance.
	*
	* @access 	public
	* @return 	Blogza 	The Blogza instance.
	**/
	public function __construct() {
		// Creates the Blogza instance. This requires all the .class.php files!
		session_start();

		// We need all the settings before we can do anything.
		require 'settings.php';

		require __DIR__ . '/includes/user.class.php';
	}

	/**
	* Starts Blogza.
	* @access	public
	* @return	void
	**/
	public function start() {
		require 'dbloader.php';
		require 'router.php';
		require 'routes.php';
		require 'templates.php';

		$this->databasemanager = new DatabaseManager();
		$this->templatemanager = new TemplateManager($this);

		$router = new Router();

		$this->routes = new Routes($router, $this);

		// Do preStart, because even though we've already started the program, we haven't initiated any pathing and page display.
		$this->preStart();

		$this->routes->prepareRouter($this->templatemanager);

	}

	/**
	* Redirect the visitor to a different page.
	*
	* @access 	public
	* @param 	string 	$url 	The URL of the new page.
	* @return 	mixed
	**/
	public static function redirect($url = BLOG_URL) {
		header("location:".$url);
	}

	/**
	* Gets the DatabaseManager instance.
	* @access	public
	* @return 	void
	**/
	public function getDatabaseManager() {
		return $this->databasemanager;
	}

	/**
	* Gets the Router instance.
	* @access	public
	* @return 	void
	**/
	public function getRouter() {
		return $this->router;
	}

	/**
	* Gets the TemplateManager instance.
	* @access	public
	* @return 	void
	**/
	public function getTemplateManager() {
		return $this->templatemanager;
	}

	/**
	* Gets the Routes instance.
	* @access	public
	* @return	Routes
	**/
	public function getRoutes() {
		return $this->routes;
	}

	/*
	*  OOO   OOO   OOO  O   O    O    OOO  OOO
	*  O  O  O  O   O   O   O   O O    O   O
	*  OOO   OOO    O    O O    OOO    O   OOO
	*  O     O  O   O    O O   O   O   O   O
	*  O     O  O  OOO    O    O   O   O   OOO
	**/

	/**
	* Handles the general pre-start functions of Blogza. This usually includes direct system work.
	*
	* @access 	private
	* @return 	void
	**/
	private function preStart() {
		require 'prestart.php';
	}

}