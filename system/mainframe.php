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
		session_start();

		require __DIR__.'/includes/user.class.php';
	}

	/**
	* Starts Blogza.
	* @access	public
	* @return	void
	**/
	public function start() {
		require 'settings.php';
		require 'dbloader.php';
		require 'router.php';
		require 'routes.php';
		require 'templates.php';

		$this->databasemanager = new DatabaseManager();
		$this->templatemanager = new TemplateManager($this);

		$router = new Router();

		$this->routes = new Routes($router);
		$this->routes->prepareRouter($this->templatemanager);

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