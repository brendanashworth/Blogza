<?php

/**
* Blogza, the open source, simple to use blogging software.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class Blogza {

	public static $name = "Blogza";

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
		//require __DIR__.'/includes/user.class.php';
	}

	/**
	* Starts Blogza.
	* @access	public
	* @return	void
	**/
	public function start() {
		session_start();

		/* Load all the .php files that are critical to the existance of the software:
		* - DatabaseManager, loads and manages the database for us
		* - Router, creates, manages, and handles all URL routes used
		* - Routes, which holds and stores all the pages necessary to build the template files per URL
		* - TemplateManager, manages and loads all the necessary template files and processes them
		* - settings.php, very generic configuration file, but necessary for all
		*/

		require 'settings.php';
		require 'dbloader.php';
		require 'router.php';
		require 'routes.php';
		require 'templates.php';

		$this->databasemanager = new DatabaseManager();

		$this->router = new Router("/home");
		$this->routes = new Routes($this);

		$this->templatemanager = new TemplateManager($this);

		$this->routes->prepareRouter();

		/* Display the generated info. */
		$router->go();

	}

	/**
	* Gets the DatabaseManager instance.
	* @access	public
	**/
	public function getDatabaseManager() {
		return $this->databasemanager;
	}

	/**
	* Gets the Router instance.
	* @access	public
	**/
	public function getRouter() {
		return $this->router;
	}

	/**
	* Gets the TemplateManager instance.
	* @access	public
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

}